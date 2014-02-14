/*
 *  FILE: open.c
 *  AUTH: mcc | jal
 *  DESC:
 *  DATE: Mon Apr  6 19:27:49 1998
 */

#include "globals.h"
#include "errno.h"
#include "fs/fcntl.h"
#include "util/string.h"
#include "util/printf.h"
#include "fs/vfs.h"
#include "fs/vnode.h"
#include "fs/file.h"
#include "fs/vfs_syscall.h"
#include "fs/open.h"
#include "fs/stat.h"
#include "util/debug.h"

/* find empty index in p->p_files[] */
int
get_empty_fd(proc_t *p)
{
        int fd;
	dbg_print("get_empty_fd called\n");
        for (fd = 0; fd < NFILES; fd++) {
                if (!p->p_files[fd]) {
			dbg_print("get_empty_fd returning fd = %d\n", fd);
                        return fd;
		}
        }

        dbg(DBG_ERROR | DBG_VFS, "ERROR: get_empty_fd: out of file descriptors "
            "for pid %d\n", curproc->p_pid);
        return -EMFILE;
}

/*
 * There a number of steps to opening a file:
 *      1. Get the next empty file descriptor.
 *      2. Call fget to get a fresh file_t.
 *      3. Save the file_t in curproc's file descriptor table.
 *      4. Set file_t->f_mode to OR of FMODE_(READ|WRITE|APPEND) based on
 *         oflags, which can be O_RDONLY, O_WRONLY or O_RDWR, possibly OR'd with
 *         O_APPEND.
 *      5. Use open_namev() to get the vnode for the file_t.
 *      6. Fill in the fields of the file_t.
 *      7. Return new fd.
 *
 * If anything goes wrong at any point (specifically if the call to open_namev
 * fails), be sure to remove the fd from curproc, fput the file_t and return an
 * error.
 *
 * Error cases you must handle for this function at the VFS level:
 *      o EINVAL
 *        oflags is not valid.
 *      o EMFILE
 *        The process already has the maximum number of files open.
 *      o ENOMEM
 *        Insufficient kernel memory was available.
 *      o ENAMETOOLONG
 *        A component of filename was too long.
 *      o ENOENT
 *        O_CREAT is not set and the named file does not exist.  Or, a
 *        directory component in pathname does not exist.
 *      o EISDIR
 *        pathname refers to a directory and the access requested involved
 *        writing (that is, O_WRONLY or O_RDWR is set).
 *      o ENXIO
 *        pathname refers to a device special file and no corresponding device
 *        exists.
 */

int
do_open(const char *filename, int oflags)
{
	/*NOT_YET_IMPLEMENTED("VFS: do_open");*/

	dbg_print("do_open: called with filename = %s, oflags = %d \n", filename, oflags);
	int fd, retval;
	file_t *new_file;
	vnode_t *new_vnode;
	/*oflags, which can be O_RDONLY, O_WRONLY or O_RDWR, possibly OR'd with O_APPEND.*/
	/*if( !(oflags == O_RDONLY || oflags == O_WRONLY || oflags == O_RDWR || oflags == (O_RDONLY | O_APPEND) || oflags == (O_WRONLY | O_APPEND) || oflags == (O_RDWR | O_APPEND)) ) {
		dbg_print("invalid oflags!!\n");
		return -EINVAL;
	}*/

	/*1. Get the next empty file descriptor.*/
 	if ( 0 > (fd = get_empty_fd(curproc)) )
		return fd; /*EMFILE*/
	/*2. Call fget to get a fresh file_t.*/
	new_file = fget(-1); /*new_file already has fref done upon it so dont call fref again*/
	/*3. Save the file_t in curproc's file descriptor table.*/
	curproc->p_files[fd] = new_file;
	/*4. Set file_t->f_mode to OR of FMODE_(READ|WRITE|APPEND) based on oflags, which can be O_RDONLY, O_WRONLY or 			O_RDWR, possibly OR'd with O_APPEND.*/
	if(oflags == O_RDONLY)
		new_file->f_mode = FMODE_READ;
	else if(oflags == (O_RDONLY|O_APPEND))
		new_file->f_mode = FMODE_READ|FMODE_APPEND;
	else if(oflags == O_WRONLY)
		new_file->f_mode = FMODE_WRITE;
	else if(oflags == (O_WRONLY|O_APPEND))
		new_file->f_mode = FMODE_WRITE|FMODE_APPEND;
	else if(oflags == O_RDWR)
		new_file->f_mode = FMODE_READ|FMODE_WRITE;
	else {
		dbg_print("do_open, f_mode set to FMODE_READ|FMODE_WRITE|FMODE_APPEND\n");		
		new_file->f_mode = FMODE_READ|FMODE_WRITE|FMODE_APPEND;
	}
	/*5. Use open_namev() to get the vnode for the file_t.*/
	if ( 0 > (retval = open_namev(filename, oflags, &new_vnode, curproc->p_cwd)) ) {
		/*something went wrong, remove the fd from curproc, fput the file_t and return an error.*/
		curproc->p_files[fd] = NULL;
		fput(new_file);
		dbg_print("do_open:something went wrong, open_namev failed, returning error = %d\n", retval);
		return retval;
	}
	/*6. Fill in the fields of the file_t.*/
	new_file->f_vnode = new_vnode;
	new_file->f_pos = 0; /*beginning of file*/
	/*7. Return new fd.*/
	dbg_print("do_open: returning fd = %d \n", fd);
	return fd;
}
