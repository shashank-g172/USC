#include "config.h"
#include "globals.h"

#include "errno.h"

#include "util/init.h"
#include "util/debug.h"
#include "util/list.h"
#include "util/string.h"

#include "proc/kthread.h"
#include "proc/proc.h"
#include "proc/sched.h"

#include "mm/slab.h"
#include "mm/page.h"

kthread_t *curthr; /* global */
static slab_allocator_t *kthread_allocator = NULL;

#ifdef __MTP__
/* Stuff for the reaper daemon, which cleans up dead detached threads */
static proc_t *reapd = NULL;
static kthread_t *reapd_thr = NULL;
static ktqueue_t reapd_waitq;
static list_t kthread_reapd_deadlist; /* Threads to be cleaned */

static void *kthread_reapd_run(int arg1, void *arg2);
#endif

void
kthread_init()
{
        kthread_allocator = slab_allocator_create("kthread", sizeof(kthread_t));
        KASSERT(NULL != kthread_allocator);
}

/**
 * Allocates a new kernel stack.
 *
 * @return a newly allocated stack, or NULL if there is not enough
 * memory available
 */
static char *
alloc_stack(void)
{
        /* extra page for "magic" data */
        char *kstack;
        int npages = 1 + (DEFAULT_STACK_SIZE >> PAGE_SHIFT);
        kstack = (char *)page_alloc_n(npages);

        return kstack;
}

/**
 * Frees a stack allocated with alloc_stack.
 *
 * @param stack the stack to free
 */
static void
free_stack(char *stack)
{
        page_free_n(stack, 1 + (DEFAULT_STACK_SIZE >> PAGE_SHIFT));
}

/*
 * Allocate a new stack with the alloc_stack function. The size of the
 * stack is DEFAULT_STACK_SIZE.
 *
 * Don't forget to initialize the thread context with the
 * context_setup function. The context should have the same pagetable
 * pointer as the process.
 * Allocates and initializes a kernel thread.
 *
 * @param p the process in which the thread will run
 * @param func the function that will be called when the newly created
 * thread starts executing
 * @param arg1 the first argument to func
 * @param arg2 the second argument to func
 * @return the newly created thread
 */
kthread_t *
kthread_create(struct proc *p, kthread_func_t func, long arg1, void *arg2)
{
        
		KASSERT(p && func && "p or func was NULL");/*check to see if p and func are not NULL*/		
		/*Allocate a new stack with the alloc_stack function. The size of the stack is DEFAULT_STACK_SIZE.*/
		char *kstack = alloc_stack();
		/*initialize the thread context with the context_setup function. The context should have the same pagetable pointer as the process.*/
		context_t newthr_ctx;
		context_setup(&newthr_ctx, func, arg1, arg2, kstack, DEFAULT_STACK_SIZE, p->p_pagedir);
		
		kthread_t *newthr = (kthread_t *) slab_obj_alloc(kthread_allocator);
			
		newthr->kt_ctx = newthr_ctx;      /* this thread's context */
		newthr->kt_kstack = kstack;      /* the kernel stack */
		newthr->kt_retval = NULL;      /* this thread's return value */
		newthr->kt_errno = 0;       /* error no. of most recent syscall */
		newthr->kt_proc = p;        /* the thread's process */
		
		newthr->kt_cancelled = 0;   /* 1 if this thread has been cancelled */
		newthr->kt_wchan = NULL;      /*The queue that this thread is blocked on */
		newthr->kt_state = KT_RUN;       /* this thread's state */
		
		/*link on ktqueue list*/
		list_link_init(&(newthr->kt_qlink)); 
		
		/*link on proc thread list*/
		list_link_init(&(newthr->kt_plink)); 
		list_insert_tail(&(p->p_threads), &(newthr->kt_plink));
		dbg(DBG_THR, "Created thread belonging to process PID:%d, PNAME:%s\n", newthr->kt_proc->p_pid, newthr->kt_proc->p_comm);
		return newthr;
}

void
kthread_destroy(kthread_t *t)
{
        KASSERT(t && t->kt_kstack);
        free_stack(t->kt_kstack);
        if (list_link_is_linked(&t->kt_plink))
                list_remove(&t->kt_plink);
        slab_obj_free(kthread_allocator, t);
}

/*
 * If the thread to be cancelled is the current thread, this is
 * equivalent to calling kthread_exit. Otherwise, the thread is
 * sleeping and we need to set the cancelled and retval fields of the
 * thread.
 *
 * If the thread's sleep is cancellable, cancelling the thread should
 * wake it up from sleep.
 *
 * If the thread's sleep is not cancellable, we do nothing else here.
 * Cancel a thread.
 *
 * @param kthr the thread to be cancelled
 * @param retval the return value for the thread
 */
void
kthread_cancel(kthread_t *kthr, void *retval)
{
        /*NOT_YET_IMPLEMENTED("PROCS: kthread_cancel");*/
	KASSERT(kthr && "pointer to thread (kthr) was NULL");
	dbg(DBG_THR, "called by thread belonging to PID:%d with retval:%d\n", curproc->p_pid, (int)retval);
	if (kthr == curthr) {
		kthread_exit(retval);
	} else {
		/*the thread is sleeping and we simply set cancelled and retval fields of this thread*/
		kthr->kt_retval = retval;
		sched_cancel(kthr);	
	}
}

/*
 * You need to set the thread's retval field, set its state to
 * KT_EXITED, and alert the current process that a thread is exiting
 * via proc_thread_exited.
 *
 * It may seem unneccessary to push the work of cleaning up the thread
 * over to the process. However, if you implement MTP, a thread
 * exiting does not necessarily mean that the process needs to be
 * cleaned up.
 * Exits the current thread.
 *
 * @param retval the return value for the thread
 */
void
kthread_exit(void *retval)
{
        /*NOT_YET_IMPLEMENTED("PROCS: kthread_exit");*/
	dbg(DBG_THR, "called by thread belonging to PID:%d with retval:%d\n", curproc->p_pid, (int)retval);
	kthread_t *thr;
	thr = curthr;
	/*setting the threads retval field and state*/
	thr->kt_retval = retval;
	thr->kt_state = KT_EXITED;
	/*alerting this threads process that its thread has exited*/
	proc_thread_exited(retval);
}

/*
 * The new thread will need its own context and stack. Think carefully
 * about which fields should be copied and which fields should be
 * freshly initialized.
 *
 * You do not need to worry about this until VM.
 */
kthread_t *
kthread_clone(kthread_t *thr)
{
        NOT_YET_IMPLEMENTED("VM: kthread_clone");
        return NULL;
}

/*
 * The following functions will be useful if you choose to implement
 * multiple kernel threads per process. This is strongly discouraged
 * unless your weenix is perfect.
 */
#ifdef __MTP__
int
kthread_detach(kthread_t *kthr)
{
        NOT_YET_IMPLEMENTED("MTP: kthread_detach");
        return 0;
}

int
kthread_join(kthread_t *kthr, void **retval)
{
        NOT_YET_IMPLEMENTED("MTP: kthread_join");
        return 0;
}

/* ------------------------------------------------------------------ */
/* -------------------------- REAPER DAEMON ------------------------- */
/* ------------------------------------------------------------------ */
static __attribute__((unused)) void
kthread_reapd_init()
{
        NOT_YET_IMPLEMENTED("MTP: kthread_reapd_init");
}
init_func(kthread_reapd_init);
init_depends(sched_init);

void
kthread_reapd_shutdown()
{
        NOT_YET_IMPLEMENTED("MTP: kthread_reapd_shutdown");
}

static void *
kthread_reapd_run(int arg1, void *arg2)
{
        NOT_YET_IMPLEMENTED("MTP: kthread_reapd_run");
        return (void *) 0;
}
#endif
