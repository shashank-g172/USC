#include "kernel.h"
#include "config.h"
#include "globals.h"
#include "errno.h"

#include "util/debug.h"
#include "util/list.h"
#include "util/string.h"
#include "util/printf.h"

#include "proc/kthread.h"
#include "proc/proc.h"
#include "proc/sched.h"
#include "proc/proc.h"

#include "mm/slab.h"
#include "mm/page.h"
#include "mm/mmobj.h"
#include "mm/mm.h"
#include "mm/mman.h"

#include "vm/vmmap.h"

#include "fs/vfs.h"
#include "fs/vfs_syscall.h"
#include "fs/vnode.h"
#include "fs/file.h"

proc_t *curproc = NULL; /* global */
static slab_allocator_t *proc_allocator = NULL;

static list_t _proc_list; /*global list of processes*/
static proc_t *proc_initproc = NULL; /* Pointer to the init process (PID 1) */
void
proc_init()
{
        list_init(&_proc_list); 
        proc_allocator = slab_allocator_create("proc", sizeof(proc_t));
        KASSERT(proc_allocator != NULL);
}

static pid_t next_pid = 0;

/**
 * Returns the next available PID.
 *
 * Note: Where n is the number of running processes, this algorithm is
 * worst case O(n^2). As long as PIDs never wrap around it is O(n).
 *
 * @return the next available PID
 */
static int
_proc_getid()
{
        proc_t *p;
        pid_t pid = next_pid;
        while (1) {
failed:
                list_iterate_begin(&_proc_list, p, proc_t, p_list_link) {
                        if (p->p_pid == pid) {
                                if ((pid = (pid + 1) % PROC_MAX_COUNT) == next_pid) {
                                        return -1;
                                } else {
                                        goto failed;
                                }
                        }
                } list_iterate_end();
                next_pid = (pid + 1) % PROC_MAX_COUNT;
                return pid;
        }
}

/*
 * The new process, although it isn't really running since it has no
 * threads, should be in the PROC_RUNNING state.
 *
 * Don't forget to set proc_initproc when you create the init
 * process. You will need to be able to reference the init process
 * when reparenting processes to the init process.
 * This function allocates and initializes a new process.
 *
 * @param name the name to give the newly created process
 * @return the newly created process
 */
proc_t *
proc_create(char *name)
{
	KASSERT(strlen(name));	
	proc_t *newproc;
	char *ptr = name;
	int i = 0;
	newproc = (proc_t *) slab_obj_alloc (proc_allocator);
	
	newproc->p_pid = _proc_getid();
	if (newproc->p_pid == PID_INIT)
		proc_initproc = newproc;
	while (*ptr != '\0') {
		*((newproc->p_comm) + i) = *ptr;
		ptr++;
		i++;
	}
	*((newproc->p_comm) + i) = *ptr;
	list_init(&(newproc->p_threads));
	list_init(&(newproc->p_children));
	if ( newproc->p_pid != PID_IDLE ) {
		list_insert_tail(&(curproc->p_children), &(newproc->p_child_link));	
	} 
	if ( newproc->p_pid == PID_IDLE ) {
		newproc->p_pproc = NULL;	
	} else {
		newproc->p_pproc = curproc;
	} 

	newproc->p_state = PROC_RUNNING;
	newproc->p_pagedir = pt_create_pagedir();
	sched_queue_init(&(newproc->p_wait));
	list_link_init(&(newproc->p_list_link)); 
	list_insert_tail(&(_proc_list), &(newproc->p_list_link));
	dbg(DBG_PROC, "Created process PID:%d, PNAME:%s\n", newproc->p_pid, newproc->p_comm);
	/*initializing the list of open files*/
	for(i = 0; i < NFILES; i++)
		newproc->p_files[i] = NULL;
	/*initializing the current working directory of process*/
	if(newproc->p_pid == PID_INIT || newproc->p_pid == PID_IDLE || newproc->p_pid == 2)
		newproc->p_cwd = NULL;
	else {
		newproc->p_cwd = curproc->p_cwd;
		vref(newproc->p_cwd);
	}
	
	return newproc;
}

/**
 * Cleans up as much as the process as can be done from within the
 * process. This involves:
 *    - Closing all open files (VFS)
 *    - Cleaning up VM mappings (VM)
 *    - Waking up its parent if it is waiting
 *    - Reparenting any children to the init process
 *    - Setting its status and state appropriately
 *
 * The parent will finish destroying the process within do_waitpid (make
 * sure you understand why it cannot be done here). Until the parent
 * finishes destroying it, the process is informally called a 'zombie'
 * process.
 *
 * This is also where any children of the current process should be
 * reparented to the init process (unless, of course, the current
 * process is the init process. However, the init process should not
 * have any children at the time it exits).
 *
 * Note: You do _NOT_ have to special case the idle process. It should
 * never exit this way.
 *
 * @param status the status to exit the process with
 */
void
proc_cleanup(int status)
{
	/*idle process shoule never exit this way*/	
	KASSERT(curproc->p_pid != PID_IDLE);	
	int i;
	kthread_t* thr;
        /*NOT_YET_IMPLEMENTED("PROCS: proc_cleanup");*/
	dbg(DBG_PROC, "called by PID: %d, PNAME:%s\n",  (curproc->p_pid), curproc->p_comm);
	
	/*setting the state and status of the exiting process*/	
	curproc->p_state = PROC_DEAD;
	curproc->p_status = status;
	
	for(i = 0; i < NFILES; i++) {
		if(curproc->p_files[i]) {
			dbg_print("PID = %d fputting file with fd = %d\n",curproc->p_pid, i); 
			fput(curproc->p_files[i]);
			curproc->p_files[i] = NULL;
		}
	}
	if(curproc->p_cwd) {
		vput(curproc->p_cwd);
		curproc->p_cwd = NULL;
	}
	/*reparenting all children of this process with the init process*/
	list_t *list = &(curproc->p_children);
	proc_t *child, *init;
	/*init = list_item((_proc_list.l_next)->l_next, proc_t, p_child_link);*/
	init = proc_initproc;
	
	if(!list_empty(list) && curproc->p_pid != PID_INIT) {
		list_iterate_begin(list, child, proc_t, p_child_link) {
			/*reparenting these children to init process*/
			list_insert_tail(&(init->p_children), &(child->p_list_link));
			child->p_pproc = proc_initproc;
		} list_iterate_end();	
	}
	if (curproc->p_pid == PID_INIT) 
		dbg(DBG_PROC, "proc_cleanup called by init itself so no reparenting done\n");
	else
		dbg(DBG_PROC, "Finished reparenting all children of PID:%d to init process\n", curproc->p_pid);
	/*waking up its parent process if it is waiting*/
	if(curproc->p_pproc->p_wait.tq_size == 1) {
		thr = sched_wakeup_on(&((curproc->p_pproc)->p_wait));
		/*sched_make_runnable(thr);	*/
	}
}

/*
 * This has nothing to do with signals and kill(1).
 *
 * Calling this on the current process is equivalent to calling
 * do_exit().
 *
 * In Weenix, this is only called from proc_kill_all.
 * Stops another process from running again by cancelling all its
 * threads.
 *
 * @param p the process to kill
 * @param status the status the process should exit with
 */
void
proc_kill(proc_t *p, int status)
{
        /*NOT_YET_IMPLEMENTED("PROCS: proc_kill");*/
	KASSERT(p && "p was NULL in proc_kill");
	dbg(DBG_PROC, "called by PID:%d to kill PID:%d\n", curproc->p_pid, p->p_pid);
	list_t *list;
	list_link_t *link;
	kthread_t *thr;
	/*caling proc_kill on current rocess is equivalent to calling do_exit()*/
	if(p == curproc) {
		do_exit(status);	
	} else {
		/*else we cancel the process thread*/
		list = &(p->p_threads);
		link = list->l_next;
		thr = list_item(link, kthread_t, kt_plink);
		kthread_cancel(thr, (void*)status);
	}
}

/*
 * Remember, proc_kill on the current process will _NOT_ return.
 * Don't kill direct children of the idle process.
 *
 * In Weenix, this is only called by sys_halt.
  * Kill every process except for the idle process.
 */
void
proc_kill_all()
{
        /*NOT_YET_IMPLEMENTED("PROCS: proc_kill_all");*/
	dbg(DBG_PROC, "called by PID:%d to kill all processes\n", curproc->p_pid);
	list_t *list = &(_proc_list);
	list_link_t *link;
	proc_t *proc;
	if(!list_empty(list)) {
		list_iterate_begin(list, proc, proc_t, p_list_link) {
				/*kill every process except for idle, and dont kill ilde's children*/
				if(proc->p_pid != PID_IDLE && (proc->p_pproc)->p_pid != PID_IDLE) {
					proc_kill(proc, 0);
				}
			} list_iterate_end();
	}
}

proc_t *
proc_lookup(int pid)
{
        proc_t *p;
        list_iterate_begin(&_proc_list, p, proc_t, p_list_link) {
                if (p->p_pid == pid) {
                        return p;
                }
        } list_iterate_end();
        return NULL;
}

list_t *
proc_list()
{
        return &_proc_list;
}

/*
 * This function is only called from kthread_exit.
 *
 * Unless you are implementing MTP, this just means that the process
 * needs to be cleaned up and a new thread needs to be scheduled to
 * run. If you are implementing MTP, a single thread exiting does not
 * necessarily mean that the process should be exited.
 */
void
proc_thread_exited(void *retval)
{
	dbg(DBG_PROC, "called by PID: %d, Pname:%s\n",  (curproc->p_pid), curproc->p_comm);
	/*the current process needs to be cleaned up, also schedules parent thread if it was waiting*/
	proc_cleanup(0);
	/*a new thread needs to be scheduled to run*/
	sched_switch();       
	/*NOT_YET_IMPLEMENTED("PROCS: proc_thread_exited");*/
}

/* If pid is -1 dispose of one of the exited children of the current
 * process and return its exit status in the status argument, or if
 * all children of this process are still running, then this function
 * blocks on its own p_wait queue until one exits.
 *
 * If pid is greater than 0 and the given pid is a child of the
 * current process then wait for the given pid to exit and dispose
 * of it.
 *
 * If the current process has no children, or the given pid is not
 * a child of the current process return -ECHILD.
 *
 * Pids other than -1 and positive numbers are not supported.
 * Options other than 0 are not supported.
 The waitpid() system call suspends execution of the calling process until a child specified by pid argument has changed state. By default,   waitpid() waits only for terminated children, -1 meaning wait for any child process. In our case idle has only one child init so this call should suspend the execution of idle process till the status of init changes
when the exit status of init is available, do_waitpid returns the pid of the terminated process, i.e in this case it returns initproc->p_pid which is 1
*/
pid_t
do_waitpid(pid_t pid, int options, int *status)
{
        /*NOT_YET_IMPLEMENTED("PROCS: do_waitpid");*/
	KASSERT(!options && "Invalid option in do_waitpid, only 0 allowed");
	KASSERT(pid == -1 || pid > 0 );
	dbg(DBG_PROC, "called by: PID:%d, PNAME: %s\n", curproc->p_pid, curproc->p_comm);
	proc_t *child;
	list_t *list = &(curproc->p_children), *children_list;
	kthread_t *thr;
	pid_t retpid;
	int flag = 0;
	if (pid == -1) {
		while(1) {
			list_iterate_begin(list, child, proc_t, p_child_link) {
				if (child->p_state == PROC_DEAD) {
					*status = child->p_status;
					dbg(DBG_PROC, "Process PID:%d cleaning up PID:%d\n", curproc->p_pid, child->p_pid);
					children_list = &(child->p_threads);
					thr = list_item(children_list->l_next, kthread_t, kt_plink);
					
					dbg(DBG_PROC, "Destroying thread belonging to PID:%d via kthread_destroy\n", child->p_pid);
					kthread_destroy(thr);
					
					retpid = child->p_pid;
					dbg(DBG_PROC, "Destroying Process PID:%d's PCB via slab_obj_free\n", retpid);
					slab_obj_free(proc_allocator, child);
					list_remove(&(child->p_child_link));
					return retpid;
				}
			} list_iterate_end();	
			dbg(DBG_PROC, "No child of PID:%d, PNAME:%s has terminated so it goes to sleep in its own waitq\n", curproc->p_pid, curproc->p_comm);
			/*no child has yet terminated, calling process must go to sleep*/	
			sched_sleep_on(&(curproc->p_wait));
			dbg(DBG_PROC, "returned after sleeping in PID:%d\n", curproc->p_pid);
		}		
	} else if (pid > 0) {
		/*if process has no children*/
		if (list_empty(list))
			return -ECHILD;
		
		while(1) {
			list_iterate_begin(list, child, proc_t, p_child_link) {
				if (child->p_pid == pid) {
					flag = 1;
					if (child->p_state == PROC_DEAD) {
						*status = child->p_status;
						dbg(DBG_PROC, "Process PID:%d cleaning up PID:%d\n", curproc->p_pid, child->p_pid);
						children_list = &(child->p_threads);
						thr = list_item(children_list->l_next, kthread_t, kt_plink);
						
						dbg(DBG_PROC, "Destroying thread belonging to PID:%d via kthread_destroy\n", child->p_pid);
						kthread_destroy(thr);

						retpid = child->p_pid;
						dbg(DBG_PROC, "Destroying Process PID:%d's PCB via slab_obj_free\n", retpid);
						slab_obj_free(proc_allocator, child);
						list_remove(&(child->p_child_link));
						return retpid;
					}
				}
			} list_iterate_end();
			/*if the given pid doesnt belong to any child*/
			if (flag == 0)
				return -ECHILD;
			/*the child whose pid was the argument has not yet terminated, calling process must go to sleep*/
			sched_sleep_on(&(curproc->p_wait));
			dbg(DBG_PROC, "returned after sleeping in PID:%d\n", curproc->p_pid);
		}
	}
return 0;
}

/*
 * Cancel all threads, join with them, and exit from the current
 * thread.
 *
 * @param status the exit status of the process
 */
void
do_exit(int status)
{
        /*NOT_YET_IMPLEMENTED("PROCS: do_exit");*/
	/*the current process can have only a single thread, so we cancel it*/
	kthread_t *thr;
	list_t *list = &(curproc->p_threads);
	thr = list_item(list->l_next, kthread_t, kt_plink);
	kthread_cancel(thr, (void*)status);
}

size_t
proc_info(const void *arg, char *buf, size_t osize)
{
        const proc_t *p = (proc_t *) arg;
        size_t size = osize;
        proc_t *child;

        KASSERT(NULL != p);
        KASSERT(NULL != buf);

        iprintf(&buf, &size, "pid:          %i\n", p->p_pid);
        iprintf(&buf, &size, "name:         %s\n", p->p_comm);
        if (NULL != p->p_pproc) {
                iprintf(&buf, &size, "parent:       %i (%s)\n",
                        p->p_pproc->p_pid, p->p_pproc->p_comm);
        } else {
                iprintf(&buf, &size, "parent:       -\n");
        }

#ifdef __MTP__
        int count = 0;
        kthread_t *kthr;
        list_iterate_begin(&p->p_threads, kthr, kthread_t, kt_plink) {
                ++count;
        } list_iterate_end();
        iprintf(&buf, &size, "thread count: %i\n", count);
#endif

        if (list_empty(&p->p_children)) {
                iprintf(&buf, &size, "children:     -\n");
        } else {
                iprintf(&buf, &size, "children:\n");
        }
        list_iterate_begin(&p->p_children, child, proc_t, p_child_link) {
                iprintf(&buf, &size, "     %i (%s)\n", child->p_pid, child->p_comm);
        } list_iterate_end();

        iprintf(&buf, &size, "status:       %i\n", p->p_status);
        iprintf(&buf, &size, "state:        %i\n", p->p_state);

#ifdef __VFS__
#ifdef __GETCWD__
        if (NULL != p->p_cwd) {
                char cwd[256];
                lookup_dirpath(p->p_cwd, cwd, sizeof(cwd));
                iprintf(&buf, &size, "cwd:          %-s\n", cwd);
        } else {
                iprintf(&buf, &size, "cwd:          -\n");
        }
#endif /* __GETCWD__ */
#endif

#ifdef __VM__
        iprintf(&buf, &size, "start brk:    0x%p\n", p->p_start_brk);
        iprintf(&buf, &size, "brk:          0x%p\n", p->p_brk);
#endif

        return size;
}

size_t
proc_list_info(const void *arg, char *buf, size_t osize)
{
        size_t size = osize;
        proc_t *p;

        KASSERT(NULL == arg);
        KASSERT(NULL != buf);

#if defined(__VFS__) && defined(__GETCWD__)
        iprintf(&buf, &size, "%5s %-13s %-18s %-s\n", "PID", "NAME", "PARENT", "CWD");
#else
        iprintf(&buf, &size, "%5s %-13s %-s\n", "PID", "NAME", "PARENT");
#endif

        list_iterate_begin(&_proc_list, p, proc_t, p_list_link) {
                char parent[64];
                if (NULL != p->p_pproc) {
                        snprintf(parent, sizeof(parent),
                                 "%3i (%s)", p->p_pproc->p_pid, p->p_pproc->p_comm);
                } else {
                        snprintf(parent, sizeof(parent), "  -");
                }

#if defined(__VFS__) && defined(__GETCWD__)
                if (NULL != p->p_cwd) {
                        char cwd[256];
                        lookup_dirpath(p->p_cwd, cwd, sizeof(cwd));
                        iprintf(&buf, &size, " %3i  %-13s %-18s %-s\n",
                                p->p_pid, p->p_comm, parent, cwd);
                } else {
                        iprintf(&buf, &size, " %3i  %-13s %-18s -\n",
                                p->p_pid, p->p_comm, parent);
                }
#else
                iprintf(&buf, &size, " %3i  %-13s %-s\n",
                        p->p_pid, p->p_comm, parent);
#endif
        } list_iterate_end();
        return size;
}
