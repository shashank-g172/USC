/*
 *  FILE: vfs_syscall.c
 *  AUTH: mcc | jal
 *  DESC:
 *  DATE: Wed Apr  8 02:46:19 1998
 *  $Id: vfs_syscall.c,v 1.1 2012/10/10 20:06:46 william Exp $
 */

#include "kernel.h"
#include "errno.h"
#include "globals.h"
#include "fs/vfs.h"
#include "fs/file.h"
#include "fs/vnode.h"
#include "fs/vfs_syscall.h"
#include "fs/open.h"
#include "fs/fcntl.h"
#include "fs/lseek.h"
#include "mm/kmalloc.h"
#include "util/string.h"
#include "util/printf.h"
#include "fs/stat.h"
#include "util/debug.h"

/* To read a file:
 *      o fget(fd)
 *      o call its virtual read f_op
 *      o update f_pos
 *      o fput() it
 *      o return the number of bytes read, or an error
 *
 * Error cases you must handle for this function at the VFS level:
 *      o EBADF
 *        fd is not a valid file descriptor or is not open for reading.
 *      o EISDIR
 *        fd refers to a directory.
 *
 * In all cases, be sure you do not leak file refcounts by returning before
 * you fput() a file that you fget()'ed.
 */
int
do_read(int fd, void *buf, size_t nbytes)
{
        /*NOT_YET_IMPLEMENTED("VFS: do_read");*/
	/*1. fget(fd)*/
	dbg_print("do_read: reading fd = %d\n", fd);
	off_t bytes_read;
	file_t *file;
	vnode_t *vnode;
	file = fget(fd);	
	if (file == NULL)
		return -EBADF; /*fd is not a valid file descriptor, no need for fput as fref wasnt called*/
	/*2.call its virtual read f_op*/
	vnode = file->f_vnode;
	if(S_ISDIR(vnode->vn_mode)) {
		fput(file);
		return -EISDIR; /*fd refers to a directory*/
	}
	dbg_print("do_read: calling file fd = %d's vnode->vn_ops->read \n", fd);
	bytes_read = vnode->vn_ops->read(vnode, file->f_pos, buf, nbytes);
	/*3.update f_pos*/
	file->f_pos = file->f_pos + bytes_read;
	/*4.fput() it*/
	fput(file); /*to decrement the reference count*/
	/*5.return the number of bytes read, or an error*/
	dbg_print("do_read returning the no of bytes read as = %d\n", bytes_read);
        return bytes_read;
}

/* Very similar to do_read.  Check f_mode to be sure the file is writable.  If
 * f_mode & FMODE_APPEND, do_lseek() to the end of the file, call the write
 * f_op, and fput the file.  As always, be mindful of refcount leaks.
 *
 * Error cases you must handle for this function at the VFS level:
 *      o EBADF
 *        fd is not a valid file descriptor or is not open for writing.
 */
int
do_write(int fd, const void *buf, size_t nbytes)
{
        /*NOT_YET_IMPLEMENTED("VFS: do_write");*/
	dbg_print("do _write: writing fd = %d\n", fd);
	off_t bytes_written;
	file_t *file;
	vnode_t *vnode;
	/*1. fget(fd)*/
	file = fget(fd);
	if (file == NULL)
		return -EBADF; /*fd is not a valid file descriptor, no need for fput as fref wasnt called*/	
	/*Check f_mode to be sure the file is writable. */
	if (!(file->f_mode & FMODE_WRITE)) {
		dbg_print("do_write, file fd = %d is not writble fputting\n");
		fput(file);
		return -EBADF; /*file is not open for writing*/
	}
	/* If f_mode & FMODE_APPEND, do_lseek() to the end of the file, call the write f_op, and fput the file.*/
	if (file->f_mode & FMODE_APPEND)
		do_lseek(fd, file->f_pos, SEEK_END);
	/*2.call its virtual write f_op*/
	vnode = file->f_vnode;
	dbg_print("do_write: calling file fd = %d's vnode->vn_ops->write \n", fd);
	bytes_written = vnode->vn_ops->write(vnode, file->f_pos, buf, nbytes);	
	/*3.update f_pos*/
	file->f_pos =file->f_pos + bytes_written;
	/*4.fput() it*/
	fput(file);
	/*5.return the number of bytes read, or an error*/
	dbg_print("do_read returning the no of bytes written as = %d\n", bytes_written);
        return bytes_written;
}

/*
 * Zero curproc->p_files[fd], and fput() the file. Return 0 on success
 *
 * Error cases you must handle for this function at the VFS level:
 *      o EBADF
 *        fd isn't a valid open file descriptor.
 */
int
do_close(int fd)
{
        /*NOT_YET_IMPLEMENTED("VFS: do_close");*/
	file_t *file;
	dbg_print("do_close: called with fd = %d\n", fd);
	if (fd < 0 || fd >= NFILES || curproc->p_files[fd] == NULL)
        	return -EBADF; /*fd isn't a valid open file descriptor.*/
	file = curproc->p_files[fd];
	/*Zero curproc->p_files[fd]*/
	curproc->p_files[fd] = NULL;
	/*fput() the file*/
	fput(file);
	/*Return 0 on success*/
        return 0;
}

/* To dup a file:
 *      o fget(fd) to up fd's refcount
 *      o get_empty_fd()
 *      o point the new fd to the same file_t* as the given fd
 *      o return the new file descriptor
 *
 * Don't fput() the fd unless something goes wrong.  Since we are creating
 * another reference to the file_t*, we want to up the refcount.
 *
 * Error cases you must handle for this function at the VFS level:
 *      o EBADF
 *        fd isn't an open file descriptor.
 *      o EMFILE
 *        The process already has the maximum number of file descriptors open
 *        and tried to open a new one.
 */
int
do_dup(int fd)
{
        /*NOT_YET_IMPLEMENTED("VFS: do_dup");*/
	dbg_print("do_dup: called with fd = %d\n", fd);
	int nfd;
	file_t *file;
	/*1.fget(fd) to up fd's refcount*/
	file = fget(fd);
	if(file == NULL) {
		return -EBADF; /*no need for fput as fref wasnt called*/
	}
	/*2.get_empty_fd()*/
	if( 0 > (nfd = get_empty_fd(curproc)) ) {
		fput(file); /*something went wrong, reverting back to the original reference count*/
		return nfd; /*-EMFILE*/
	}
	/*3.point the new fd to the same file_t* as the given fd*/
	curproc->p_files[nfd] = file;
	/*4.return the new file descriptor*/
        return nfd;
}

/* Same as do_dup, but insted of using get_empty_fd() to get the new fd,
 * they give it to us in 'nfd'.  If nfd is in use (and not the same as ofd)
 * do_close() it first.  Then return the new file descriptor.
 *
 * Error cases you must handle for this function at the VFS level:
 *      o EBADF
 *        ofd isn't an open file descriptor, or nfd is out of the allowed
 *        range for file descriptors.
 */
int
do_dup2(int ofd, int nfd)
{
        /*NOT_YET_IMPLEMENTED("VFS: do_dup2");*/
	dbg_print("do_dup2: called with ofd = %d nfd = %d\n", ofd, nfd);
	file_t *file;
	int retval;
	/*1.fget(ofd) to up fd's refcount*/
	file = fget(ofd);
	if(file == NULL) {
		return -EBADF; /*ofd isn't an open file descriptor, no need for fput*/
	}
	if (nfd < 0 || nfd >= NFILES) {
		fput(file);
        	return -EBADF; /*nfd is out of the allowed range of file descriptors*/
	}
	/*2.If nfd is in use (and not the same as ofd) do_close() it first.*/
	if(curproc->p_files[nfd] != NULL && nfd != ofd) {
		if(0 > (retval = do_close(nfd)) )
			return retval; /*error in do_close*/
	}
	/*3.point the new fd to the same file_t* as the given fd*/
	curproc->p_files[nfd] = file;
	/*4.return the new file descriptor*/
        return nfd;
}

/*
 * This routine creates a special file of the type specified by 'mode' at
 * the location specified by 'path'. 'mode' should be one of S_IFCHR or
 * S_IFBLK (you might note that mknod(2) normally allows one to create
 * regular files as well-- for simplicity this is not the case in Weenix).
 * 'devid', as you might expect, is the device identifier of the device
 * that the new special file should represent.
 *
 * You might use a combination of dir_namev, lookup, and the fs-specific
 * mknod (that is, the containing directory's 'mknod' vnode operation).
 * Return the result of the fs-specific mknod, or an error.
 *
 * Error cases you must handle for this function at the VFS level:
 *      o EINVAL
 *        mode requested creation of something other than a device special
 *        file.
 *      o EEXIST
 *        path already exists.
 *      o ENOENT
 *        A directory component in path does not exist.
 *      o ENOTDIR
 *        A component used as a directory in path is not, in fact, a directory.
 *      o ENAMETOOLONG
 *        A component of path was too long.
 */
int
do_mknod(const char *path, int mode, unsigned devid)
{
        /*NOT_YET_IMPLEMENTED("VFS: do_mknod");*/
	int retval, retval2;
	vnode_t *res_vnode, *res_vnode2, *result;
	size_t namelen;
	char name[30];
	dbg_print("do_mknod: called with path: %s, mode = %d, devid = %d\n", path, mode, devid);
	if(!(S_ISCHR(mode) || S_ISBLK(mode)))
		return -EINVAL; /*mode requested creation of something other than a device special file*/
	if( 0 > (retval = dir_namev(path, &namelen, &name, curproc->p_cwd, &res_vnode)) )
		return retval;
	vput(res_vnode);
	dbg_print("do_mknod: dir_namev returned name = %s, namelen = %d\n", name, namelen);
	if( 0 == (retval2 = lookup(res_vnode, name, namelen, &res_vnode2)) ) {
		vput(res_vnode2);	
		return -EEXIST; /*-EEXIST*/
	}
	dbg_print("do_mknod: lookup returned retval = %d, OK, proceeding to create node\n", retval2);
	retval = res_vnode->vn_ops->mknod(res_vnode, name, namelen, mode, devid);
	dbg_print("do_mknod: called the mknod vn_ops, retval = %d\n", retval);
	if( 0 > (retval = lookup(res_vnode, name, namelen, &result)) ) {
		dbg_print("do_mknod: The newly created node not found! weird\n");
		return retval;
	}
        return retval;
}

/* Use dir_namev() to find the vnode of the dir we want to make the new
 * directory in.  Then use lookup() to make sure it doesn't already exist.
 * Finally call the dir's mkdir vn_ops. Return what it returns.
 *
 * Error cases you must handle for this function at the VFS level:
 *      o EEXIST
 *        path already exists.
 *      o ENOENT
 *        A directory component in path does not exist.
 *      o ENOTDIR
 *        A component used as a directory in path is not, in fact, a directory.
 *      o ENAMETOOLONG
 *        A component of path was too long.
 */
int
do_mkdir(const char *path)
{
        /*NOT_YET_IMPLEMENTED("VFS: do_mkdir");*/
	int retval;
	vnode_t *res_vnode, *result, *result2;
	size_t namelen;
	char name[30];
	dbg_print("do_mkdir: called with path: %s\n", path);
	/*1.Use dir_namev() to find the vnode of the dir we want to make the new directory in.*/
	if( 0 > (retval = dir_namev(path, &namelen, &name, curproc->p_cwd, &res_vnode)) )
		return retval;	
	vput(res_vnode); /*as dir_namev returns with the refcount on *res_vnode increased*/
	/*2.use lookup() to make sure it doesn't already exist.*/
	if( 0 == (retval = lookup(res_vnode, name, namelen, &result)) ) {
		vput(result);
		return -EEXIST;
	}
	/*3.Finally call the dir's mkdir vn_ops*/
	dbg_print("do_mkdir: calling the vnodes vn_ops mkdir to create dir entry\n");
	retval = res_vnode->vn_ops->mkdir(res_vnode, name, namelen);
	if( 0 > (retval = lookup(res_vnode, name, namelen, &result)) ) {
		dbg_print("do_mkdir: The newly created dir not found! weird error\n");
		return retval;
	}
	dbg_print("do_mkdir: success, retval of ramfs_mkdir = %d\n", retval);
	return retval;
}

/* Use dir_namev() to find the vnode of the directory containing the dir to be
 * removed. Then call the containing dir's rmdir v_op.  The rmdir v_op will
 * return an error if the dir to be removed does not exist or is not empty, so
 * you don't need to worry about that here. Return the value of the v_op,
 * or an error.
 *
 * Error cases you must handle for this function at the VFS level:
 *      o EINVAL
 *        path has "." as its final component.
 *      o ENOTEMPTY
 *        path has ".." as its final component.
 *      o ENOENT
 *        A directory component in path does not exist.
 *      o ENOTDIR
 *        A component used as a directory in path is not, in fact, a directory.
 *      o ENAMETOOLONG
 *        A component of path was too long.
 */
int
do_rmdir(const char *path)
{
        /*NOT_YET_IMPLEMENTED("VFS: do_rmdir");*/
	dbg_print("do_rmdir: called with path = %s\n", path);
	int retval;
	vnode_t *res_vnode, *result;
	size_t namelen;
	char name[30];
	/*1. Use dir_namev() to find the vnode of the directory containing the dir to be removed*/
	if( 0 > (retval = dir_namev(path, &namelen, &name, curproc->p_cwd, &res_vnode)) )
		return retval;
	vput(res_vnode);
	/*2.call the containing dir's rmdir v_op*/
	retval = res_vnode->vn_ops->rmdir(res_vnode, name, namelen);
        return retval;
}

/*
 * Same as do_rmdir, but for files.
 *
 * Error cases you must handle for this function at the VFS level:
 *      o EISDIR
 *        path refers to a directory.
 *      o ENOENT
 *        A component in path does not exist.
 *      o ENOTDIR
 *        A component used as a directory in path is not, in fact, a directory.
 *      o ENAMETOOLONG
 *        A component of path was too long.
 */
int
do_unlink(const char *path)
{
        /*NOT_YET_IMPLEMENTED("VFS: do_unlink");*/
	dbg_print("do_unlink: called with path = %s\n", path);
	int retval;
	vnode_t *res_vnode, *result;
	size_t namelen;
	char name[30];
	/*1. Use dir_namev() to find the vnode of the directory containing the dir to be removed*/
	if( 0 > (retval = dir_namev(path, &namelen, &name, NULL, &res_vnode)) )
		return retval;
	if( 0 > (retval = lookup(res_vnode, name, namelen, &result)) )
		return retval;
	vput(res_vnode);
	/*2.call the containing dir's unlink v_op*/
	retval = res_vnode->vn_ops->unlink(res_vnode, name, namelen);
        return retval;
}

/* To link:
 *      o open_namev(from)
 *      o dir_namev(to)
 *      o call the destination dir's (to) link vn_ops.
 *      o return the result of link, or an error
 *
 * Remember to vput the vnodes returned from open_namev and dir_namev.
 *
 * Error cases you must handle for this function at the VFS level:
 *      o EEXIST
 *        to already exists.
 *      o ENOENT
 *        A directory component in from or to does not exist.
 *      o ENOTDIR
 *        A component used as a directory in from or to is not, in fact, a
 *        directory.
 *      o ENAMETOOLONG
 *        A component of from or to was too long.
 */
int
do_link(const char *from, const char *to)
{
        /*NOT_YET_IMPLEMENTED("VFS: do_link");*/
	dbg_print("do_link: called with from = %s, to = %s\n", from, to);
	int retval;
	vnode_t *open_namev_res, *dir_namev_res, *result;
	size_t namelen;
	char name[30];
	/*1. open_namev(from)*/
	if ( 0 > (retval = open_namev(from, O_RDWR, &open_namev_res, curproc->p_cwd)) )
		return retval;
	vput(open_namev_res);
	/*2.dir_namev(to)*/
	if(0 > (retval = dir_namev(to, &namelen, &name, curproc->p_cwd, &dir_namev_res)) )
		return retval;
	vput(dir_namev_res);
	/*3.call the destination dir's (to) link vn_ops.*/
	/* ??? name and name len are they correct*/
	retval = dir_namev_res->vn_ops->link(open_namev_res, dir_namev_res, name, namelen);
	/*4.return the result of link, or an error*/
	return retval;
}

/*      o link newname to oldname
 *      o unlink oldname
 *      o return the value of unlink, or an error
 *
 * Note that this does not provide the same behavior as the
 * Linux system call (if unlink fails then two links to the
 * file could exist).
 */
int
do_rename(const char *oldname, const char *newname)
{
        /*NOT_YET_IMPLEMENTED("VFS: do_rename");*/
	dbg_print("do_rename: called with oldname = %s, newname = %s\n", oldname, newname);
	int retval;
	/*1. link newname to oldname*/
	if( 0 > (retval = do_link(newname, oldname)) )
		return retval;
 	/*2. unlink oldname*/
	if( 0 > (retval = do_unlink(oldname)) )
		return retval;
	/*3. return the value of unlink, or an error*/
        return retval;
}

/* Make the named directory the current process's cwd (current working
 * directory).  Don't forget to down the refcount to the old cwd (vput()) and
 * up the refcount to the new cwd (open_namev() or vget()). Return 0 on
 * success.
 *
 * Error cases you must handle for this function at the VFS level:
 *      o ENOENT
 *        path does not exist.
 *      o ENAMETOOLONG
 *        A component of path was too long.
 *      o ENOTDIR
 *        A component of path is not a directory.
 */
int
do_chdir(const char *path)
{
        /*NOT_YET_IMPLEMENTED("VFS: do_chdir");*/
	dbg_print("do_chdir called: with path = %s\n", path);
	int retval;
	vnode_t *old_cwd, *new_cwd;
	old_cwd = curproc->p_cwd;
	
	/*up the refcount to the new cwd (open_namev() or vget())*/
	if( 0 > (retval = open_namev(path, O_RDWR, &new_cwd, old_cwd)) )
		return retval;
	/*down the refcount to the old cwd (vput())*/
	vput(old_cwd);
	curproc->p_cwd = new_cwd;
	dbg_print("do_chdir: the vnode %d is made CWD for the curproc pid = %d \n", new_cwd->vn_vno, curproc->p_pid);
	/*return 0 on success*/
        return 0;
}

/* Call the readdir f_op on the given fd, filling in the given dirent_t*.
 * If the readdir f_op is successful, it will return a positive value which
 * is the number of bytes copied to the dirent_t.  You need to increment the
 * file_t's f_pos by this amount.  As always, be aware of refcounts, check
 * the return value of the fget and the virtual function, and be sure the
 * virtual function exists (is not null) before calling it.
 *
 * Return either 0 or sizeof(dirent_t), or -errno.
 *
 * Error cases you must handle for this function at the VFS level:
 *      o EBADF
 *        Invalid file descriptor fd.
 *      o ENOTDIR
 *        File descriptor does not refer to a directory.
 */
int
do_getdent(int fd, struct dirent *dirp)
{
        /*NOT_YET_IMPLEMENTED("VFS: do_getdent");*/
	dbg_print("do_getdent: called with fd = %d\n", fd);
	int bytes_copied;
	file_t *file;
	vnode_t *vnode;
	off_t offset;
	file = fget(fd);
	if(file == NULL)
		return -EBADF; /*fd is not a valid file descriptor*/
	fput(file); /*as we want to keep the same reference count*/
	vnode = file->f_vnode;	
	dbg_print("do_getdent vnode no = %d\n", vnode->vn_vno);
	if(!S_ISDIR(vnode->vn_mode))
		return -ENOTDIR;
	offset = file->f_pos;
	/*check that the virtual function is not NULL*/
	KASSERT(vnode->vn_ops->readdir);
	bytes_copied = vnode->vn_ops->readdir(vnode, offset, dirp);
	file->f_pos += bytes_copied;
	dbg_print("do_dirent: returned bytes_copied as %d\n", bytes_copied);
	/*return either 0 or sizeof(dirent_t)*/
	if(bytes_copied > 0 )
	        return sizeof(dirent_t);
	else
		return 0;	
}

/*
 * Modify f_pos according to offset and whence.
 *
 * Error cases you must handle for this function at the VFS level:
 *      o EBADF
 *        fd is not an open file descriptor.
 *      o EINVAL
 *        whence is not one of SEEK_SET, SEEK_CUR, SEEK_END; or the resulting
 *        file offset would be negative.
 */
int
do_lseek(int fd, int offset, int whence)
{
        /*NOT_YET_IMPLEMENTED("VFS: do_lseek");*/
	dbg_print("in do_lseek\n");
	if(!(whence == SEEK_SET || whence == SEEK_CUR || whence == SEEK_END))
		return -EINVAL;
	file_t *file;
	file = fget(fd);
	if(file == NULL)
		return -EBADF; /*fd is not a valid file descriptor*/
	/*fput(file);*. /*as we want to keep the same reference count*/
	if(whence == SEEK_SET) {
		file->f_pos = offset; 	
	} else if(whence == SEEK_CUR) {
		file->f_pos += offset;	
	} else {
		/*how to reach end of file??? by using vn_len from file->f_vnode maybe?*/	
		file->f_pos = file->f_vnode->vn_len;
	}
        return 0;
}

/*
 * Find the vnode associated with the path, and call the stat() vnode operation.
 *
 * Error cases you must handle for this function at the VFS level:
 *      o ENOENT
 *        A component of path does not exist.
 *      o ENOTDIR
 *        A component of the path prefix of path is not a directory.
 *      o ENAMETOOLONG
 *        A component of path was too long.
 */
int
do_stat(const char *path, struct stat *buf)
{
        /*NOT_YET_IMPLEMENTED("VFS: do_stat");*/
	dbg_print("do_stat: called with path = %s\n", path);
	vnode_t *res_vnode;
	int retval;
	/*1.Find the vnode associated with the path*/
	if( 0 > (retval = open_namev(path, O_RDWR, &res_vnode, curproc->p_cwd)) )
		return retval;
	/*2.call the stat() vnode operation*/
	vput(res_vnode);
        res_vnode->vn_ops->stat(res_vnode, buf);
	
	dbg_print("do_stat: returning after filling buf\n");
	return 0;
}

#ifdef __MOUNTING__
/*
 * Implementing this function is not required and strongly discouraged unless
 * you are absolutely sure your Weenix is perfect.
 *
 * This is the syscall entry point into vfs for mounting. You will need to
 * create the fs_t struct and populate its fs_dev and fs_type fields before
 * calling vfs's mountfunc(). mountfunc() will use the fields you populated
 * in order to determine which underlying filesystem's mount function should
 * be run, then it will finish setting up the fs_t struct. At this point you
 * have a fully functioning file system, however it is not mounted on the
 * virtual file system, you will need to call vfs_mount to do this.
 *
 * There are lots of things which can go wrong here. Make sure you have good
 * error handling. Remember the fs_dev and fs_type buffers have limited size
 * so you should not write arbitrary length strings to them.
 */
int
do_mount(const char *source, const char *target, const char *type)
{
        NOT_YET_IMPLEMENTED("MOUNTING: do_mount");
        return -EINVAL;
}

/*
 * Implementing this function is not required and strongly discouraged unless
 * you are absolutley sure your Weenix is perfect.
 *
 * This function delegates all of the real work to vfs_umount. You should not worry
 * about freeing the fs_t struct here, that is done in vfs_umount. All this function
 * does is figure out which file system to pass to vfs_umount and do good error
 * checking.
 */
int
do_umount(const char *target)
{
        NOT_YET_IMPLEMENTED("MOUNTING: do_umount");
        return -EINVAL;
}
#endif
