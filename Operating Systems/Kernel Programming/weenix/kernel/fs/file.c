/*
 *  FILE: file.c
 *  AUTH: mcc | mahrens
 *  DESC:
 *  DATE: Fri Apr  3 20:38:30 1998
 */

#include "kernel.h"
#include "util/init.h"
#include "util/debug.h"
#include "util/string.h"
#include "util/printf.h"
#include "globals.h"
#include "util/list.h"
#include "fs/file.h"
#include "fs/vfs.h"
#include "fs/vnode.h"
#include "proc/proc.h"
#include "mm/slab.h"
#include "config.h"

static slab_allocator_t *file_allocator;

static __attribute__((unused)) void
file_init(void)
{
        file_allocator = slab_allocator_create("file", sizeof(file_t));
}
init_func(file_init);

/*
 * fref() increments the reference count on the given file.
 */
void
fref(file_t *f)
{
        KASSERT(f->f_mode >= 0 && f->f_mode < 8);
        KASSERT(f->f_pos >= -1);
        KASSERT(f->f_refcount >= 0);
        if (f->f_refcount != 0) KASSERT(f->f_vnode);

        f->f_refcount++;

        if (f->f_vnode) {
                dbg(DBG_FREF, "fref: 0x%p, 0x%p ino %lu, up to %d\n",
                    f, f->f_vnode->vn_fs, (unsigned long) f->f_vnode->vn_vno,
                    f->f_refcount);
        } else {
                dbg(DBG_FREF, "fref: 0x%p up to %d\n", f, f->f_refcount);
        }
}

/*
 * Returns the file_t assiciated with the given file descriptor for the
 * current process. If there is no associated file_t, returns NULL.
 *
 * If the passed fd == -1, a new file_t, not associated with any process
 * or file descriptor, is created and returned with its refcount set to
 * 1.
 */
/* Look in process fd table and return the file*. */
file_t *
fget(int fd)
{
        file_t *f;

        if (fd == -1) {
                f = slab_obj_alloc(file_allocator);
                if (f) memset(f, 0, sizeof(file_t));
        } else {
                if (fd < 0 || fd >= NFILES)
                        return NULL;
                f = curproc->p_files[fd];
        }
        if (f) fref(f);

        return f;
}

/*
 * fput() decrements the reference count on the given file.
 *
 * If the refcount reaches 0, the storage for the given file_t will be
 * released (f won't point to a valid memory address anymore), and the
 * refcount on the associated vnode (if any) will be decremented.
 */
/* - Decrement f_count.
 * - If f_count == 0, call vput() and free it. */
void
fput(file_t *f)
{
        KASSERT(f);
        KASSERT(f->f_mode >= 0 && f->f_mode < 8);
        KASSERT(f->f_pos >= -1);
        KASSERT(f->f_refcount > 0);
        if (f->f_refcount != 1) KASSERT(f->f_vnode);

        f->f_refcount--;

        if (f->f_vnode) {
                dbg(DBG_FREF, "fput: 0x%p, 0x%p ino %lu, down to %d\n",
                    f, f->f_vnode->vn_fs, (unsigned long) f->f_vnode->vn_vno,
                    f->f_refcount);
        } else {
                dbg(DBG_FREF, "fput: 0x%p down to %d\n", f, f->f_refcount);
        }

        if (f->f_refcount == 0) {
                if (f->f_vnode) vput(f->f_vnode);
                slab_obj_free(file_allocator, f);
        }
}
