#include<stdio.h>
#include<stdlib.h>

#include "cs402.h"
#include "my402list.h"


/*int main ()
    {

    My402List *s,*list_all_purpose;
    int oolean=My402ListInit(s);
    printf("The list is Initialized if the value is 1. It is currently %d \n", oolean);
    return 0;
    }
*/


int My402ListInit(My402List *list)
{
    //list=(My402List*) malloc (sizeof(My402List));

   
        list->num_members = 0;
 //if(list->num_members!=0)
//return 0;
 
      list->anchor.prev = &list->anchor;
 if(list->anchor.prev!=&list->anchor) return 0;
       list->anchor.next = &list->anchor;
 if(list->anchor.next!=&list->anchor) return 0;

//     printf("Initialized\n");
    
     return 1;
   
    
   

}

 int  My402ListAppend(My402List *list, void *data)
{
    /* if(!checkinput(list))
    {
      printf("The input is not valid, and cannot be appended\n");
      return 0;
    }
    else*/
int old= list->num_members;
My402ListElem *DataHeldIn, *Last;
      DataHeldIn=(My402ListElem *)malloc (sizeof(My402ListElem));
         
//printf("%d\n",&list->anchor.prev);
        Last=list->anchor.prev;    /*define the last member by connecting prev of new list */
            
    Last->next=DataHeldIn;
         DataHeldIn->next=&list->anchor;     /*connect new list to first element*/
    list->anchor.prev=DataHeldIn;       /*connect first element back to new list*/
    DataHeldIn->prev=Last;              /*same thing for the last element*/
    
   
DataHeldIn->obj=data;

    list->num_members++;
    return 1;
if(old++ !=list->num_members) return 0;
}



int  My402ListPrepend(My402List *list, void *data)
{
    My402ListElem *First,*DataHeldIn;
    /* if(!checkinput(list))
    {
      printf("The input is not valid, and cannot be prepended\n");
      return 0;
    }
    else */
int old= list->num_members;
      DataHeldIn=(My402ListElem *)malloc(sizeof(My402ListElem));
     
    
    First=list->anchor.next;/*define the first member by connecting next of  list */

     First->prev=DataHeldIn;     /*connect new list to first element*/
     DataHeldIn->prev=&list->anchor;
     list->anchor.next=DataHeldIn;
     DataHeldIn->next=First;     /*connect first element back to new list*/
         
DataHeldIn->obj=data;

list->num_members++;

    return 1;
if(old++ !=list->num_members) return 0;
}

int My402ListLength(My402List *list)
{

    /*while(first->next!=last->prev)
     {
       number++;
       first=first->next;
     }*/
     //printf("The count is %d",number);

        /*if(first->next==last->prev)
         {
           number=1;
         }*/

 return list->num_members;
}


 My402ListElem *My402ListFirst(My402List *list)
{
  My402ListElem *First;
   First= list->anchor.next;
  
  if(list->anchor.next == &list->anchor) return NULL;
   return First;
}


My402ListElem *My402ListLast(My402List *list)
{
  My402ListElem *last;
 last= list->anchor.prev;
 
   if(list->anchor.prev == &list->anchor) return NULL;
  return last;
 }

 My402ListElem *My402ListNext(My402List *list, My402ListElem *Current )
{
     My402ListElem *NextOnList;
    NextOnList=Current->next;
    if(NextOnList != &list->anchor) return NextOnList;
   return NULL;
}

 My402ListElem *My402ListPrev(My402List *list, My402ListElem *Current)
{
  My402ListElem *PrevOnList;
 
 PrevOnList=Current->prev;
    if(PrevOnList != &list->anchor) return PrevOnList; 

 return NULL;
}



int  My402ListEmpty(My402List *list)
{
  
  
       if(list->num_members!=0)
        {return 0;
         printf("The list isn't empty\n");}
        else
    {        return 1;
        printf("The list is empty\n"); }
   
}

void My402ListUnlink(My402List *list, My402ListElem *Delete)
{
  My402ListElem *BeforeDelete,*AfterDelete;
  BeforeDelete=Delete->prev;
  AfterDelete=Delete->next;
  if(Delete->obj!=NULL)
    {
       free(Delete);
    }

  BeforeDelete->next=AfterDelete;
  AfterDelete->prev=BeforeDelete;

 list->num_members--;
}

void My402ListUnlinkAll(My402List *list)
{
    My402ListElem *elem=NULL;  
    for (elem=My402ListFirst(list);
    elem != NULL;elem=My402ListNext(list, elem))
     {
            free(elem);
         }
   list->anchor.next=list->anchor.prev;
   list->anchor.prev=list->anchor.next;

list->num_members=0;

}


int  My402ListInsertAfter(My402List *list , void *data, My402ListElem *current)
{
       
int old= list->num_members;
  My402ListElem *Next,*PrevNext;

if(current->next == &list->anchor)
   My402ListAppend(list,data);
else {
  Next=(My402ListElem *)malloc (sizeof(My402ListElem));
    

  PrevNext=current->next;
 

 current->next=Next;// &&      
  Next->next= PrevNext;//) 
PrevNext->prev= Next ;//&&
Next->prev = current;// &&
      
   Next->obj=data;
       
list->num_members++;
  if(old++ !=list->num_members) return 0;

    return 1;
        
       }   
  return 1;
}
 
int  My402ListInsertBefore(My402List *list, void *data, My402ListElem *current)
{

 int old = list->num_members;  
 My402ListElem *Previous,*PrevPrev;

if(current->prev==&list->anchor)

    My402ListPrepend(list,data);
else {
  Previous=(My402ListElem *)malloc (sizeof(My402ListElem));
    
        PrevPrev= current->prev;
 

       current->prev=Previous ;//&&
      Previous->prev=PrevPrev;     //&&
    PrevPrev->next =Previous ;//&&   
             Previous->next=current ;//)          
          
           Previous->obj=data;
list->num_members++;
if(old++ !=list->num_members) return 0;

            return 1;

     }
   return 1;
}

My402ListElem *My402ListFind(My402List *list, void *data)
 {
  //My402ListElem *DataHeldIn;
   My402ListElem *elem=NULL;
   //DataHeldIn=(My402ListElem *)malloc (sizeof(My402ListElem));

   //DataHeldIn->obj=data;   

    for (elem=My402ListFirst(list);
    elem != NULL;elem=My402ListNext(list, elem))
      {
      if(elem->obj==data)
          return elem;
      }   
           return NULL;       
     
 
}

 



 
/**void SortInput(My402List*);
void PrintStatement(My402List*);**/

/**void Traverse(My402List *list)
{
My402ListElem *elem=NULL;
for (elem=My402ListFirst(list);
elem != NULL;
elem=My402ListNext(list, elem)) {
Foo *foo= (Foo*) (elem->obj);

printf("Foo exists\n");
}
}

SortInput(My402List *);
PrintStatement(My402List *);
ReadInput(FILE fp, My402List list);**/

 
 
/**void checkinput(My402List*)
{
My402List *list;
if(arv[3]!='\0')
 FILE *fp=stdin;
else
unsigned char buf[80];
buf[0] = ’\0’; **/ /* initialization */
/**strncpy(buf, sizeof(buf), *argv[1]);
buf[sizeof(buf)-1] = ’\0’; **//* in case *argv[1] is long */

/**if (!My402ListInit(list)) {  printf("Incorrect Initialization\n"); }
if (!ReadInput(fp, list)) { printf("Input cannot be read\n"); }
if (fp != stdin) fclose(fp);
SortInput(&list);
PrintStatement(&list);
}**/


