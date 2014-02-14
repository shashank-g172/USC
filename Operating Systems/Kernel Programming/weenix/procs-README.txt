Kernel 1:
Group Members: Amritaansh Verma, Shashank Gowdagiri, Kayomars Batliwalla

Descripton of Test Cases:

Once the init process starts running it creates 5 child processes and threads and enqueues them in the runq.
Then the init process waits for its children to terminate by calling do_waitpid().
Do_waitpid examines the children list of init and finds that none of the child processes have terminated, so it puts the init thread to sleep on the init process waitq, and calls sched_switch(). sched_switch removes the first thread form the runq and starts its execution.

All the 5 test processes run the same function "testfunc" which increments a global integer variable "x" 100 times. Each process first tries to lock a mutex, and then proceeds to increment "x" and then unlocks the mutex. Since in Weenix a thread runs till completion(i.e no preemption) to demonstrate that mutex actually works the currently running thread has to switch itself out while still holing the mutex. The code for this has been commented out so just uncomment it.

What now happens is that testproc with PID: 3 locks the mutex, increments "x" 50 times, and then puts itself on the runq and calls sched_ switch(). This causes the execution of testproc with PID:4 to begin, however it finds the mutex locked and is put in the mutex waitq. The same happens for till testproc with PID:7. Then testproc with PID:3 runs again, it increments x 50 more times, and calls kmutex_unlock() and terminates. This call removes the first thread on the mutex waitq, puts it on the runq, grants it the mutex and calls sched_switch(). Now in testproc with PID:4 the call to kmutex_lock() returns and it increments x 100 times. The same thing happes for the 3 other threads. 

*A thread upon termination calls kthread_exit(), which calls proc_thread_exited() which calls proc_cleanup() and then sched_switch().
*proc_thread_exited(): calls proc_cleanup() and then sched_switch() to schedula a new thread for execution.
*proc_cleanup() does two things: 1. reparents the caling processes children to init, 2. Wakes up the calling processes parent if it was sleeping. 
*When do_waitpid returns in the calling process it examines its list of children again to see which one died, and cleans up completly after that process by calling kthread_destroy() and frees up the PCB by calling slab_ojb_free().


+Test case for do_waitpid() edge cases:(commented out in code, uncomment to check)
There are two edge cases:
1. Wrong options on invalid pid
2. Calling do_waitpid on child prosesses in random order 

+Test case for forcing child processes to terminate out of order(are commented out in code, uncomment to check)
1. We have called kthread_cancel on children with PID: 4 and 6.

+Test case for proc_kill_all():(commented out in code, uncomment to check)
1. We have called proc_kill_all() right after we create the 5 child processes, uncomment to test that the processes are cleaned up properly.

+Test case to demonstrate that threads and processes exit cleanly.(Run code as it is)

+Test case to show that multiple threads are running and that they are working properly.(Run code as it is)

+Test case to demonstrate that the synchronization primitives work.(uncomment the lines in testfunc whilch call sched_switch() after locking a mutex, )


