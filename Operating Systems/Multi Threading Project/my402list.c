#include<stdio.h>
#include<stdlib.h>
#include<malloc.h>
#include "my402list.h"
int My402ListInit(My402List* p)
	{
		p->num_members=0;
		p->anchor.next=&p->anchor;
		p->anchor.prev=&p->anchor;
		return TRUE; 
	}
int My402ListLength(My402List* p)
	{
		return p->num_members;
	}
int My402ListAppend(My402List* p, void* obj)
	{
		My402ListElem *temp =(My402ListElem*) malloc(sizeof(My402ListElem));
		if(temp==NULL)
			return FALSE;
		temp->obj=obj;
		temp->next=&p->anchor;
		temp->prev=p->anchor.prev;
		p->anchor.prev->next=temp;
		p->anchor.prev=temp;
		p->num_members++;
		return TRUE;
	}
int My402ListPrepend(My402List* p, void* obj)
	{
		My402ListElem *temp =(My402ListElem*) malloc(sizeof(My402ListElem));
		if(temp==NULL)
			return FALSE;
		temp->obj=obj;
		temp->prev=&p->anchor;
		temp->next=p->anchor.next;
		p->anchor.next->prev=temp;
		p->anchor.next=temp;
		p->num_members++;
		return TRUE;
	}
My402ListElem *My402ListFirst(My402List* p)
{
		if(p->anchor.next==&p->anchor)
			return NULL;
		else
			return p->anchor.next;
}
My402ListElem *My402ListLast(My402List* p)
{
		if(p->anchor.prev==&p->anchor)
			return NULL;
		else
			return p->anchor.prev;
}
My402ListElem *My402ListNext(My402List* p, My402ListElem* e)
{	
		if(e->next==&p->anchor)
			return NULL;
		else
			return e->next;
}
My402ListElem *My402ListPrev(My402List* p, My402ListElem* e)
{	
		if(e->prev==&p->anchor)
			return NULL;
		else
			return e->prev;
}
void My402ListUnlink(My402List* p, My402ListElem* e)
{
	if(e==NULL)
		return;
	if(e==&p->anchor)
		return;
	e->next->prev=e->prev;
	e->prev->next=e->next;
	p->num_members--;
	free(e);
}
void My402ListUnlinkAll(My402List* p)
{
	int i=0;
	int count=p->num_members;
	for(i=0;i<count;i++)
		{
			My402ListUnlink(p,p->anchor.next);
		}
}
int  My402ListInsertAfter(My402List* p, void* obj, My402ListElem* e)
{
	My402ListElem *temp =(My402ListElem*) malloc(sizeof(My402ListElem));
	if(temp==NULL)
		return FALSE;
	temp->obj=obj;
	temp->prev=e;
	temp->next=e->next;
	e->next->prev=temp;
	e->next=temp;
	p->num_members++;
	return TRUE;
}
int  My402ListInsertBefore(My402List* p, void* obj, My402ListElem* e)
{
	My402ListElem *temp =(My402ListElem*) malloc(sizeof(My402ListElem));
	if(temp==NULL)
		return FALSE;
	temp->obj=obj;
	temp->next=e;
	temp->prev=e->prev;
	e->prev->next=temp;
	e->prev=temp;
	p->num_members++;
	return TRUE;
}
My402ListElem *My402ListFind(My402List* p, void* obj)
{
	int i;
	int count=p->num_members;
	My402ListElem *temp;
	temp=&p->anchor;
	for(i=0;i<count;i++)
		{
			temp=temp->next;
			if(temp->obj==obj)
				return temp;	
		}
	return NULL;
}
int  My402ListEmpty(My402List* p)
{
if(p->num_members==0)
return TRUE;
else
return FALSE;
}
