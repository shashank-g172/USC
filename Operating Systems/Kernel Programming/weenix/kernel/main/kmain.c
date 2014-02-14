#include "types.h"
#include "globals.h"
#include "kernel.h"

#include "util/gdb.h"
#include "util/init.h"
#include "util/debug.h"
#include "util/string.h"
#include "util/printf.h"

#include "mm/mm.h"
#include "mm/page.h"
#include "mm/pagetable.h"
#include "mm/pframe.h"

#include "vm/vmmap.h"
#include "vm/shadow.h"
#include "vm/anon.h"

#include "main/acpi.h"
#include "main/apic.h"
#include "main/interrupt.h"
#include "main/cpuid.h"
#include "main/gdt.h"

#include "proc/sched.h"
#include "proc/proc.h"
#include "proc/kthread.h"

#include "drivers/dev.h"
#include "drivers/blockdev.h"
#include "drivers/tty/virtterm.h"

#include "api/exec.h"
#include "api/syscall.h"

#include "fs/vfs.h"
#include "fs/vnode.h"
#include "fs/vfs_syscall.h"
#include "fs/fcntl.h"
#include "fs/stat.h"

#include "test/kshell/kshell.h"


GDB_DEFINE_HOOK(boot)
GDB_DEFINE_HOOK(initialized)
GDB_DEFINE_HOOK(shutdown)

static void      *bootstrap(int arg1, void *arg2);
static void      *idleproc_run(int arg1, void *arg2);
static kthread_t *initproc_create(void);
static void      *initproc_run(int arg1, void *arg2);
static void       hard_shutdown(void);
static void	 *kshellfunc(int arg1, void *arg2); /*kshell thread*/
static context_t bootstrap_context;
extern int vfstest_main (int argc, char **argv);

int x = 1; /*global integer*/
kmutex_t mutex; /*global mutex*/
/**
 * This is the first real C function ever called. It performs a lot of
 * hardware-specific initialization, then creates a pseudo-context to
 * execute the bootstrap function in.
 */
void
kmain()
{
        GDB_CALL_HOOK(boot);

        dbg_init();
        dbgq(DBG_CORE, "Kernel binary:\n");
        dbgq(DBG_CORE, "  text: 0x%p-0x%p\n", &kernel_start_text, &kernel_end_text);
        dbgq(DBG_CORE, "  data: 0x%p-0x%p\n", &kernel_start_data, &kernel_end_data);
        dbgq(DBG_CORE, "  bss:  0x%p-0x%p\n", &kernel_start_bss, &kernel_end_bss);

        page_init();

        pt_init();
        slab_init();
        pframe_init();

        acpi_init();
        apic_init();
        intr_init();

        gdt_init();

        /* initialize slab allocators */
#ifdef __VM__
        anon_init();
        shadow_init();
#endif
        vmmap_init();
        proc_init();
        kthread_init();

#ifdef __DRIVERS__
        bytedev_init();
        blockdev_init();
#endif

        void *bstack = page_alloc();
        pagedir_t *bpdir = pt_get();
        KASSERT(NULL != bstack && "Ran out of memory while booting.");
        context_setup(&bootstrap_context, bootstrap, 0, NULL, bstack, PAGE_SIZE, bpdir);
        context_make_active(&bootstrap_context);

        panic("\nReturned to kmain()!!!\n");
}

/**
 * This function is called from kmain, however it is not running in a
 * thread context yet. It should create the idle process which will
 * start executing idleproc_run() in a real thread context.  To start
 * executing in the new process's context call context_make_active(),
 * passing in the appropriate context. This function should _NOT_
 * return.
 *
 * Note: Don't forget to set curproc and curthr appropriately.
 *
 * @param arg1 the first argument (unused)
 * @param arg2 the second argument (unused)
 */
static void *
bootstrap(int arg1, void *arg2)
{
        pt_template_init();
	proc_t *idleproc;
	idleproc = proc_create("idle");
	kthread_t *idlethr;
	idlethr = kthread_create(idleproc, idleproc_run, 0, NULL);
	curproc = idleproc;
	curthr = idlethr;	
	dbg(DBG_TEST, "Starting the idle process by switching context to idle thr\n");
	context_make_active(&(idlethr->kt_ctx));
        panic("weenix returned to bootstrap()!!! BAD!!!\n");
        return NULL;
}

/**
 * Once we're inside of idleproc_run(), we are executing in the context of the
 * first process-- a real context, so we can finally begin running
 * meaningful code.
 *
 * This is the body of process 0. It should initialize all that we didn't
 * already initialize in kmain(), launch the init process (initproc_run),
 * wait for the init process to exit, then halt the machine.
 *
 * @param arg1 the first argument (unused)
 * @param arg2 the second argument (unused)
 */
static void *
idleproc_run(int arg1, void *arg2)
{
        int status;
        pid_t child;
        
	/* create init proc */
        kthread_t *initthr = initproc_create();

        init_call_all();
        GDB_CALL_HOOK(initialized);

        /* Create other kernel threads (in order) */

#ifdef __VFS__
        /* Once you have VFS remember to set the current working directory
         * of the idle and init processes */
	curproc->p_cwd = vfs_root_vn;
	vref(curproc->p_cwd);
	

        /* Here you need to make the null, zero, and tty devices using mknod */
	int retval;
	dbg_print("\n\nMaking dir /dev \n");
	if( 0 > (retval = do_mkdir("/dev")) ){
		dbg_print("do_mkdir failed error %d\n", retval);	
	}
	dbg_print("\n\nidle proc calling do_mknod for /dev/null\n");
	retval = do_mknod("/dev/null", S_IFCHR, MEM_NULL_DEVID); /*making null device*/
	dbg_print("do_mknod for /dev/null retval = %d\n", retval);

	dbg_print("\n\nidle proc calling do_mknod for /dev/zero\n");
	retval = do_mknod("/dev/zero", S_IFCHR, MEM_ZERO_DEVID); /*making zero device*/
	dbg_print("do_mknod for /dev/zero retval = %d\n", retval);

	dbg_print("\n\nidle proc calling do_mknod for /dev/tty0\n");
	retval = do_mknod("/dev/tty0", S_IFCHR, (MKDEVID(2, 0))); /*making tty device*/
	dbg_print("do_mknod for /dev/tty0 retval = %d\n", retval);


        /* You can't do this until you have VFS, check the include/drivers/dev.h
         * file for macros with the device ID's you will need to pass to mknod */
	
#endif

        /* Finally, enable interrupts (we want to make sure interrupts
         * are enabled AFTER all drivers are initialized) */
        intr_enable();

        /* Run initproc */
        sched_make_runnable(initthr);

        /* Now wait for it*/
        child = do_waitpid(-1, 0, &status);
        KASSERT(PID_INIT == child);
	/*dbg_print("CLOSING all open files for PID = %d\n", curproc->p_pid);
	int fd;
	for (fd = 0; fd < NFILES; fd++) {
                if (curproc->p_files[fd]) {
			dbg_print("Calling do close\n");
			do_close(fd);
		}
        }*/

#ifdef __MTP__
        kthread_reapd_shutdown();
#endif


#ifdef __VFS__
        /* Shutdown the vfs: */
        dbg_print("weenix: vfs shutdown...\n");
       
        if (vfs_shutdown())
                panic("vfs shutdown FAILED!!\n");

#endif

        /* Shutdown the pframe system */
#ifdef __S5FS__
        pframe_shutdown();
#endif

        dbg_print("\nweenix: halted cleanly!\n");
        GDB_CALL_HOOK(shutdown);
        hard_shutdown();
        return NULL;
}

/**
 * This function, called by the idle process (within 'idleproc_run'), creates the
 * process commonly refered to as the "init" process, which should have PID 1.
 *
 * The init process should contain a thread which begins execution in
 * initproc_run().
 *
 * @return a pointer to a newly created thread which will execute
 * initproc_run when it begins executing
 */
static kthread_t *
initproc_create(void)
{
        /*create the init process with PID = 1, init process should contain a thread which begins execution in initproc_run()*/
		proc_t *initproc;
		initproc = proc_create ("init");
		kthread_t *initthr;
		initthr = kthread_create(initproc, initproc_run, 0, NULL);
		/*return a pointer to the newly created thread which will execute initproc_run when it begins executing*/
		return initthr;
}

/**
 * The init thread's function changes depending on how far along your Weenix is
 * developed. Before VM/FI, you'll probably just want to have this run whatever
 * tests you've written (possibly in a new process). After VM/FI, you'll just
 * exec "/bin/init".
 *
 * Both arguments are unused.
 *
 * @param arg1 the first argument (unused)
 * @param arg2 the second argument (unused)
 */
static void *
initproc_run(int arg1, void *arg2)
{
        /*NOT_YET_IMPLEMENTED("PROCS: initproc_run");*/
	curproc->p_cwd = vfs_root_vn;
	vref(curproc->p_cwd);

	int status, i, retpid;
	kmutex_init(&mutex);
	dbg(DBG_TEST, "RUNNING INIT PROCESS\n");
	dbg(DBG_TEST, "INIT PROCESS CREATING KSHELL PROCESS AND ITS THREAD\n");
	proc_t *test_p;
	kthread_t *test_t;
	test_p = proc_create("kshellproc");
	test_t = kthread_create(test_p, kshellfunc, 0, NULL);    
	sched_make_runnable(test_t);
	retpid = do_waitpid(-1, 0, &status);
	dbg(DBG_TEST, "do_waitpid returned in init process: terminated child's pid is:%d\n", retpid);
	return NULL;
}

/*test thread, tries to lock mutex and increments global x 100 times*/

static void* kshellfunc (int arg1, void *arg2) {
	/* Create a kshell on a tty */
	curproc->p_cwd = vfs_root_vn;
	int err = 0, retval;
	dbg_print("RUNNING KSHELL PROCESS\n");
	dbg_print("Creating a kshell on ttyid = 0\n");
	kshell_t *ksh = kshell_create(0);
	KASSERT(ksh && "did not create a kernel shell as expected");
	/* Run kshell commands until user exits */
	while ((err = kshell_execute_next(ksh)) > 0){
		/*vfs_is_in_use(vfs_root_vn->vn_fs);*/
	}
	KASSERT(err == 0 && "kernel shell exited with an error\n");
	kshell_destroy(ksh);
	dbg_print("KSHELL PROCESS EXITING WITH retval 0\n");
	return (void*)0;
}


/**
 * Clears all interrupts and halts, meaning that we will never run
 * again.
 */
static void
hard_shutdown()
{
#ifdef __DRIVERS__
        vt_print_shutdown();
#endif
        __asm__ volatile("cli; hlt");
}
