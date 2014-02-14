#include "kernel.h"
#include "globals.h"
#include "types.h"
#include "errno.h"

#include "util/string.h"
#include "util/printf.h"
#include "util/debug.h"

#include "fs/dirent.h"
#include "fs/fcntl.h"
#include "fs/stat.h"
#include "fs/vfs.h"
#include "fs/vnode.h"

/* This takes a base 'dir', a 'name', its 'len', and a result vnode.
 * Most of the work should be done by the vnode's implementation
 * specific lookup() function, but you may want to special case
 * "." and/or ".." here depnding on your implementation.
 *
 * If dir has no lookup(), return -ENOTDIR.
 *
 * Note: returns with the vnode refcount on *result incremented.
 */
int
lookup(vnode_t *dir, const char *name, size_t len, vnode_t **result)
{
        /*NOT_YET_IMPLEMENTED("VFS: lookup");*/
	dbg_print("lookup: searching for %s\n", name);
	KASSERT(dir && result && name);
	int retval;
	/*If dir has no lookup(), return -ENOTDIR*/
	if(!(dir->vn_ops->lookup))
		return -ENOTDIR; /*If dir has no lookup(), return -ENOTDIR.*/
	/*use dir vnode's implementation specific lookup function to do most of the work*/
	if(0 > (retval = dir->vn_ops->lookup(dir, name, len, result)) ) {
		dbg_print("lookup: failed, couldnt find %s returning error %d\n", name, retval);
		return retval;
	}
	
	dbg_print("lookup: search SUCCESSFUL, returning 0\n");
	/*successful lookup so return 0, also the reference count on *result is already incremented by vget in ramfs_lookup*/
        return 0;
}


/* When successful this function returns data in the following "out"-arguments:
 *  o res_vnode: the vnode of the parent directory of "name"
 *  o name: the `basename' (the element of the pathname)
 *  o namelen: the length of the basename
 *
 * For example: dir_namev("/s5fs/bin/ls", &namelen, &name, NULL, &res_vnode) 
 * would put 2 in namelen, "ls" in name, and a pointer to the
 * vnode corresponding to "/s5fs/bin" in res_vnode.
 *
 * The "base" argument defines where we start resolving the path from:
 * A base value of NULL means to use the process's current working directory,
 * curproc->p_cwd.  If pathname[0] == '/', ignore base and start with
 * vfs_root_vn.  dir_namev() should call lookup() to take care of resolving each
 * piece of the pathname.
 *
 * Note: A successful call to this causes vnode refcount on *res_vnode to
 * be incremented.
 */
int
dir_namev(const char *pathname, size_t *namelen, const char **name, vnode_t *base, vnode_t **res_vnode)
{
        /*NOT_YET_IMPLEMENTED("VFS: dir_namev");*/
	dbg_print("in dir_namev searching for path = %s\n", pathname);
	KASSERT(pathname && namelen && name && res_vnode);
	vnode_t *temp_dir, *temp_result;
	char *a[MAXPATHLEN/NAME_LEN];
	char *ptr = pathname, *t;
	int i = 0, count = 0, retval;
	if(*pathname == '/')
		temp_dir = vfs_root_vn;
	else if(base)
		temp_dir = base;
	else 
		temp_dir = curproc->p_cwd;
	temp_result = temp_dir;
	if(*pathname == '/' && strlen(pathname) == 1) {
		*res_vnode = vfs_root_vn;
		vref(vfs_root_vn);
		*namelen = 0;
		strcpy(name, "");
		dbg_print("dir_namev: success, returning name = %s, size = %d\n", name, strlen(name));
		return 0;	
	}
	
	ptr = strtok(pathname, "/");
	while(ptr != NULL) {
		t = kmalloc(NAME_LEN + 1);
		strcpy(t, ptr);
		a[count] = t;
		ptr = strtok(NULL, "/");
		count++;
	}
	int k = 0;
	while(k < count - 1) {
		if( 0 > (retval = lookup(temp_dir, a[k], strlen(a[k]), &temp_result)) )
				return retval;
		dbg_print("in dir_namev retval of lookup = %d\n", retval);
		vput(temp_result);
		k++;
	}
	
	*res_vnode = temp_result;
	vref(temp_result);
	*namelen = strlen(a[count-1]);
	strcpy(name, a[count-1]);
	dbg_print("dir_namev: success, returning name = %s, size = %d\n", name, strlen(name));
	return 0;
}


/* This returns in res_vnode the vnode requested by the other parameters.
 * It makes use of dir_namev and lookup to find the specified vnode (if it
 * exists).  flag is right out of the parameters to open(2); see
 * <weenix/fnctl.h>.  If the O_CREAT flag is specified, and the file does
 * not exist call create() in the parent directory vnode.
 *
 * Note: Increments vnode refcount on *res_vnode.
 */
int
open_namev(const char *pathname, int flag, vnode_t **res_vnode, vnode_t *base)
{
        /*NOT_YET_IMPLEMENTED("VFS: open_namev");*/
	dbg_print("open_namev: searching for %s with flag = %d\n", pathname, flag);
	char name[30];
	size_t namelen;
	int retval, retval2;
	vnode_t *temp_result_vnode, *final_result_vnode;
	/*if O_CREAT flag is specified*/ 
	if(flag & O_CREAT) {
		dbg_print("open_namev: flag & O_CREAT is true \n");
		if(0 > (retval = dir_namev(pathname, &namelen, &name, base, &temp_result_vnode)) ) {
			return retval;/*-ENOENT*/
		}
		vput(temp_result_vnode);
		dbg_print("open_namev: dir_namev succeeded returned name = %s\n", name);
		if(0 > (retval = lookup(temp_result_vnode, name, namelen, &final_result_vnode)) ) {
		/*file does not exist, calling create() in the parent directory vnode*/
		if( 0 > (retval2 = temp_result_vnode->vn_ops->create(temp_result_vnode, name, namelen, &final_result_vnode)) )
			return retval2; /*-ENOSPC returned from failure of ramfs_create in parent directory*/
		}
		*res_vnode = final_result_vnode;
		return 0;
	} else {
		dbg_print("open_namev: flag & O_CREAT is false \n");
		/*calling dir_namev to find out required vnode's parent directory's vnode*/
		if(0 > (retval = dir_namev(pathname, &namelen, &name, base, &temp_result_vnode)) )
			return retval; /*-ENOENT*/
		dbg_print("open_namev: vput the leaf's parent \n");
		vput(temp_result_vnode);
		dbg_print("open_namev: dir_namev succeeded returned name = %s\n", name);
		/*calling to see if the vnode exists in the parent directory*/
		if(0 > (retval = lookup(temp_result_vnode, name, namelen, &final_result_vnode)) )
			return retval; /*-ENOENT*/
		dbg_print("open_namev: lookup succeeded\n");
		*res_vnode = final_result_vnode;
		return 0;	
	}
}

#ifdef __GETCWD__
/* Finds the name of 'entry' in the directory 'dir'. The name is writen
 * to the given buffer. On success 0 is returned. If 'dir' does not
 * contain 'entry' then -ENOENT is returned. If the given buffer cannot
 * hold the result then it is filled with as many characters as possible
 * and a null terminator, -ERANGE is returned.
 *
 * Files can be uniquely identified within a file system by their
 * inode numbers. */
int
lookup_name(vnode_t *dir, vnode_t *entry, char *buf, size_t size)
{
        NOT_YET_IMPLEMENTED("GETCWD: lookup_name");
        return -ENOENT;
}


/* Used to find the absolute path of the directory 'dir'. Since
 * directories cannot have more than one link there is always
 * a unique solution. The path is writen to the given buffer.
 * On success 0 is returned. On error this function returns a
 * negative error code. See the man page for getcwd(3) for
 * possible errors. Even if an error code is returned the buffer
 * will be filled with a valid string which has some partial
 * information about the wanted path. */
ssize_t
lookup_dirpath(vnode_t *dir, char *buf, size_t osize)
{
        NOT_YET_IMPLEMENTED("GETCWD: lookup_dirpath");

        return -ENOENT;
}
#endif /* __GETCWD__ */
