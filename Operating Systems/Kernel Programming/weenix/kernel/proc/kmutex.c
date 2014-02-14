#include "globals.h"
#include "errno.h"

#include "util/debug.h"

#include "proc/kthread.h"
#include "proc/kmutex.h"

/*
 * IMPORTANT: Mutexes can _NEVER_ be locked or unlocked from an
 * interrupt context. Mutexes are _ONLY_ lock or unlocked from a
 * thread context.
 * Initializes the fields of the specified kmutex_t.
 *
 * @param mtx the mutex to initialize
 */
void
kmutex_init(kmutex_t *mtx)
{
        /*NOT_YET_IMPLEMENTED("PROCS: kmutex_init");*/
	KASSERT(mtx && "Mutex is NULL in kmutex_init()");
	sched_queue_init(&(mtx->km_waitq));
	mtx->km_holder = NULL;
}

/*
 * This should block the current thread (by sleeping on the mutex's
 * wait queue) if the mutex is already taken.
 *
 * No thread should ever try to lock a mutex it already has locked.
 * Locks the specified mutex.
 *
 * Note: This function may block.
 *
 * Note: These locks are not re-entrant
 *
 * @param mtx the mutex to lock
 */
void
kmutex_lock(kmutex_t *mtx)
{
        /*NOT_YET_IMPLEMENTED("PROCS: kmutex_lock");*/
	KASSERT(mtx && "Mutex is NULL in kmutex_lock()");
	/*if a thread tries to lock a mutex that it already holds*/
	KASSERT(curthr != mtx->km_holder && "A thread tried to lock a mutex it already holds");
	if (mtx->km_holder == NULL) {
		dbg(DBG_SYSCALL, "Mutex LOCKED by thread belonging to PID:%d\n", curproc->p_pid);
		mtx->km_holder = curthr;
	} else {
		dbg(DBG_SYSCALL, "Mutex already LOCKED, thread belonging to PID:%d put on wait queue for this mutex; size of mutex queue is:%d\n", curproc->p_pid, (mtx->km_waitq).tq_size + 1);	
		sched_sleep_on(&(mtx->km_waitq));
		dbg(DBG_SYSCALL, "Thread belonging to PID:%d returned from mutex waitq, now holds the mutex\n", curproc->p_pid);
	}
}

/*
 * This should do the same as kmutex_lock, but use a cancellable sleep
 * instead.
 * Locks the specified mutex, but puts the current thread into a
 * cancellable sleep if the function blocks.
 *
 * Note: This function may block.
 *
 * Note: These locks are not re-entrant.
 *
 * @param mtx the mutex to lock
 * @return 0 if the current thread now holds the mutex and -EINTR if
 * the sleep was cancelled and this thread does not hold the mutex
 */
int
kmutex_lock_cancellable(kmutex_t *mtx)
{
        /*NOT_YET_IMPLEMENTED("PROCS: kmutex_lock_cancellable");*/
	KASSERT(mtx);
	if (mtx->km_holder == NULL) {
		dbg(DBG_SYSCALL, "Mutex LOCKED by thread belonging to PID:%d\n", curproc->p_pid);
		mtx->km_holder = curthr;
		/*return 0 if the current thread now holds the mutex*/		
		return 0;
	} else {
		dbg(DBG_SYSCALL, "Mutex already LOCKED, thread belonging to PID:%d put on wait queue for this mutex\n", curproc->p_pid);
		sched_cancellable_sleep_on(&(mtx->km_waitq));
		/*return -EINTR if the sleep was cancelled and this thread does not hold the mutex*/
		return -EINTR;	
	}
}

/*
 * If there are any threads waiting to take a lock on the mutex, one
 * should be woken up and given the lock.
 *
 * Note: This should _NOT_ be a blocking operation!
 *
 * Note: Don't forget to add the new owner of the mutex back to the
 * run queue.
 *
 * Note: Make sure that the thread on the head of the mutex's wait
 * queue becomes the new owner of the mutex.
 *
 * @param mtx the mutex to unlock
 * Unlocks the specified mutex.
 *
 * @mtx the mutex to unlock
 */
void
kmutex_unlock(kmutex_t *mtx)
{
        /*NOT_YET_IMPLEMENTED("PROCS: kmutex_unlock");*/
	KASSERT(mtx && "Mutex is NULL in kmutex_unlock()");
	KASSERT(mtx->km_holder == curthr && "A thread tried to unlock a mutex it does not hold");
	kthread_t *new_holder;
	if (!sched_queue_empty(&(mtx->km_waitq))) {
		dbg(DBG_SYSCALL, "Waking up threads waiting on mutex wait queue\n");
		new_holder = sched_wakeup_on(&(mtx->km_waitq));
		mtx->km_holder = new_holder;
		sched_make_runnable(new_holder);
	} else {
		dbg(DBG_SYSCALL, "mutex wait queue empty\n");
		mtx->km_holder = NULL;	
	}
	dbg(DBG_SYSCALL, "Mutex UNLOCKED by PID:%d\n", curproc->p_pid);
}
