#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include<locale.h>
#include<time.h>
#include<monetary.h>
#include </home/sgowdagi/cs402.h>
#include </home/sgowdagi/my402list.h>
#include </home/sgowdagi/my402list.c>
typedef struct Data{
	        char posneg[2];
		char timestamp[10];
	        char value[20];
		char description[25];
		} EnteredData;
FILE *fp;

PrintDate(EnteredData *well)
{
if(well->timestamp==NULL) {printf("Error!");}
int i=0;
char date[16]="";
char *buf;
time_t raw_time=atoi(well->timestamp);
buf=(char *) malloc (sizeof(char)*26);
//printf("%s\n",well->timestamp);
//char *temp=(char*)malloc (sizeof(char));
//temp=ctime(&raw_time);
//temp[strlen(temp)-1]='\0';
buf= ctime(&raw_time);
//printf("%s", buf);
//printf(" %s",ctime(&raw_time));
//printf(" %s", well->timestamp);
date[0] = buf[0];
date[1] = buf[1];
date[2] = buf[2];
date[3] = buf[3];
date[4] = buf[4];
date[5] = buf[5];
date[6] = buf[6];
date[7] = buf[7];
date[8] = buf[8];
date[9] = buf[9];
date[10] = buf[10];
date[11] = buf[20];
date[12] = buf[21];
date[13] = buf[22];
date[14] = buf[23];
date[15] = '\0';
	printf(" | %-1s ", date);

}

PrintDescription(EnteredData *well)
{
int i=0;
char buf[24]="";
char buf1[24]="";

	if(strlen(well->description)>24) 
			{ printf("Description too long");}


int length=strlen(well->description);
//printf("| %s", well->description);
int difference=24-length;
strncpy(buf, well->description,strlen(well->description));
for(i=0;i<difference;i++) buf1[i]=' ';
	buf1[difference]='\0';
//printf("| %s", buf);
//printf("buf1:%s:",buf1);
printf("| %s%s |", buf,buf1);

/*well->description[strlen(buf1)-difference]='\0';
char die[difference]=' ';
die[strlen(buf1)]='\0';
for(i=strlen(well->description);i<strlen(buf1);i++) printf( "%s ", die[i]); */
}

double balance=0;

PrintAmount(EnteredData *well)
{
char buf[14];
char buf1[14];
char *temp=well->value;
int i=0;
int length=strlen(well->value);
int difference=14-length;

if(well->posneg[0]=='-')
	{
	strncpy(buf,well->value,strlen(well->value));
	balance = balance - atof(buf);
setlocale(LC_ALL,"en_CA.UTF-8");
strfmon(temp,100,"%!(#7n | ", -atof(buf));
printf(" %s ", temp );

}
if(well->posneg[0]=='+')
	{
	strncpy(buf,well->value,strlen(well->value));
	balance = balance + atof(buf);
setlocale(LC_ALL,"en_CA.UTF-8");
strfmon(temp,100,"%!#7n  |",atof(buf));
printf(" %s ", temp );	
}
//printf("buf1:%s:",buf1);

	for(i=0;i<difference;i++) buf1[i]=' ';
	buf1[difference]='\0';
	
	//if(well->posneg[0]=='-')
	//{
	//strncpy(buf,well->value,strlen(well->value));
//	printf("|(%s%.2f)|", buf1,atof(buf));

setlocale(LC_ALL,"en_CA.UTF-8");

	//}

//else
	


}


PrintBalance(EnteredData *well)
{
char buf[14];
char buf1[14];
char *temp=well->value;
int i=0;

int length=strlen(well->value);
int difference=14-length;
double disp;


//printf("buf1:%s:",buf1);


	if(well->posneg[0]=='-')
	{
	//strncpy(buf,well->value,strlen(well->value));
	//balance = balance - atof(buf);
	for(i=0;i<difference;i++) buf1[i]=' ';
	buf1[difference]='\0';
	if(balance<0) disp=-balance;
	//printf("|(%s%-1.2f)|\n", buf1,balance);
//printf("|");	
strfmon(temp,100,"%!(#7n|",balance);

setlocale(LC_ALL,"en_CA.UTF-8");
printf(" %s\n", temp );
//printf("|");

	}
else
	if(well->posneg[0]=='+')
	{
	
	//strncpy(buf,well->value,strlen(well->value));
	//balance = balance + atof(buf);	
	for(i=0;i<difference;i++) buf1[i]=' ';
	buf1[difference]='\0';
	
	//printf("| %s%-1.2f |\n", buf1,balance);
	
strfmon(temp,100,"%!#7n |",balance);
setlocale(LC_ALL,"en_CA.UTF-8");
printf(" %s\n", temp);
	}
}

void PrintStatement(My402List *list)
{
int i=0;
My402ListElem *elem=NULL;
EnteredData *well;
char date, description,amount;
int num_items=My402ListLength(list);

for (elem=My402ListFirst(list);
    elem != NULL;elem=My402ListNext(list, elem))
	{
	well=(EnteredData*)elem->obj;
					
	PrintDate(well); 
	PrintDescription(well); 
	PrintAmount(well); 
	
	PrintBalance(well);
	}

}  



static
void aBubbleForward(My402List *pList, My402ListElem **pp_elem1, My402ListElem **pp_elem2)
    /* (*pp_elem1) must be closer to First() than (*pp_elem2) */
{
    My402ListElem *elem1=(*pp_elem1), *elem2=(*pp_elem2);
    void *obj1=elem1->obj, *obj2=elem2->obj;
    My402ListElem *elem1prev=My402ListPrev(pList, elem1);
/*  My402ListElem *elem1next=My402ListNext(pList, elem1); */
/*  My402ListElem *elem2prev=My402ListPrev(pList, elem2); */
    My402ListElem *elem2next=My402ListNext(pList, elem2);

    My402ListUnlink(pList, elem1);
    My402ListUnlink(pList, elem2);
    if (elem1prev == NULL) {
        (void)My402ListPrepend(pList, obj2);
        *pp_elem1 = My402ListFirst(pList);
    } else {
        (void)My402ListInsertAfter(pList, obj2, elem1prev);
        *pp_elem1 = My402ListNext(pList, elem1prev);
    }
    if (elem2next == NULL) {
        (void)My402ListAppend(pList, obj1);
        *pp_elem2 = My402ListLast(pList);
    } else {
        (void)My402ListInsertBefore(pList, obj1, elem2next);
        *pp_elem2 = My402ListPrev(pList, elem2next);
    }
}

static
void aBubbleSortForwardList(My402List *pList, int num_items)
{
    My402ListElem *elem=NULL;
    int i=0;
	

    	if (My402ListLength(pList) != num_items) {
        fprintf(stderr, "List length is not %1d in aBubbleSortForwardList().\n", num_items);
        exit(1);
    }
    for (i=0; i < num_items; i++) {
        int j=0, something_swapped=FALSE;
        My402ListElem *next_elem=NULL;
	EnteredData *curr, *next;

        for (elem=My402ListFirst(pList), j=0; j < num_items-i-1; elem=next_elem, j++) {
	    curr = (EnteredData*)elem->obj;
            int cur_val=(int)(curr->timestamp), next_val=0;

            next_elem=My402ListNext(pList, elem);
	    next = (EnteredData*)next_elem->obj; 
            next_val = (int)(next->timestamp);

            if (cur_val < next_val) {
                aBubbleForward(pList, &elem, &next_elem);
                something_swapped = TRUE;
            }
        }
        if (!something_swapped) break;
                                  }
//printf("bubble sort done\n");
}


SortInput(My402List *list)
{
int num= My402ListLength(list);
//printf("sorting data\n");
aBubbleSortForwardList(list,num);

 My402ListElem *elem=NULL;
EnteredData *data,*data2; 
for (elem=My402ListFirst(list);
    elem != NULL;elem=My402ListNext(list, elem)){
data = (EnteredData*)(elem->obj);
data2= (EnteredData*)elem->next->obj;
/*printf("%s\t\n", data->posneg);
printf("%s\t\n", data->timestamp);
printf("%s\t\n", data->value);
printf("%s\n", data->description);*/
if(data2->timestamp==data->timestamp)
{printf("Identical Timestamp\n"); exit(0);}
						}
}

								
   

int val1(EnteredData *well)
{

   if(well->posneg[0] != '+') 
		if(well->posneg[0]!= '-')
			{printf("Invalid operator\n");return 0;}

	else  {
		printf("val 1 done\n");return 1;}
}

int val2(EnteredData *well,FILE *fp)
{
time_t raw_time;
int checker2=atoi(well->timestamp);
time_t raw_time1;
int checker,checker1;
time(&raw_time1);
checker=atoi((char *)&raw_time);
checker1; atoi((char *)&raw_time1);
if(checker>checker1)
	if(checker > 4294967295u)
		
		 {printf("Error in timestamp\n");
		return 0;}

 return 1;
}

int val3(EnteredData *well)
{
float valcheck=atof(well->value);
int nod=strlen(well->value);
int i=0;
char start[20];
strcpy(start,well->value);
char * dpoint=strchr(start,'.');	
//printf("%d",strlen(dpoint));
int valcheck2=atoi(well->value);
	if(valcheck2>10000000) {printf("Data enetered too large\n");return 0;} 
		if(nod>11)    {printf("Length of number too large\n"); exit(0);return 0;}
		    if(strlen(dpoint)>3)
				return 0;


return 1;
}

int val4(EnteredData *well)
{
char *endpoint;
if(well->description==NULL)
{printf("DEsc is empty");
			
	return 0;
}else	
	{//printf(" %s", well->description);
return 1;}
} 
/*int isdigit(EnteredData *well)
{
int i=0;
for(i=0;i<9;i++)
{
if(well->timestamp[i]=="A..Z,a..z") {return 0;};
if(well->timestamp[i]=='\0') {return 0;}
}
return 1;
} */

int ReadInput(FILE *fp, My402List *list,char* argv[])
{
	
	//printf("Reading Input now\n");
	My402ListElem *Dd;
	EnteredData *well;
		int i=0;
		char buf[1024];
		int count;	
		My402ListInit(list);				
		
		//printf("you have reached the end of the file\n");}
					 
			while(fgets(buf,sizeof(buf),fp)!=NULL)
				{
				if(strlen(buf)> 1024) {printf("Line too long\n"); exit(0);}
				well=(EnteredData*)malloc(sizeof(EnteredData));
				/*parsing*/	
				
	count=0; for(i=0;i<strlen(buf);i++)	{if(buf[i]=='\t') {count ++;} if(count>4) {printf("Too many tabs\n"); exit(0); }}
					char *start_ptr = buf;
						char *tab_ptr = strchr(start_ptr, '\t');
						if (tab_ptr != NULL) 
							*tab_ptr++ = '\0';	
							else		exit(0);

strncpy(well->posneg,buf,strlen(buf));

//printf("%s\t", well->posneg);
//for(*start_ptr=buf[1];*start_ptr!=*tab_ptr;*start_ptr++)
//for(i=0;i<strlen(start_ptr);i++)
//well->posneg[i]=*start_ptr;
//if(strncpy(&well->posneg[i],start_ptr,strlen(start_ptr)))

								     					     	
							if( start_ptr != tab_ptr)
							start_ptr = tab_ptr;
							tab_ptr = strchr(start_ptr, '\t');
							if (tab_ptr != NULL) 
					         		*tab_ptr++ = '\0';
							else		exit(0);

//char *new1=start_ptr;
//int temp1=atoi(start_ptr);
//printf("%d",temp1);
strncpy(well->timestamp,start_ptr,9);

//time_t rtime=(time_t)well->timestamp;
//printf("Ctime:%s\n",ctime(&rtime));
//printf(":%s\n",start_ptr);
//printf("%s\n",well->timestamp);
//printf("%d", atoi(well->timestamp));
//printf("%s\t",well->timestamp);
//int timestamp;
//timestamp=atoi(well->timestamp);
//char *c=well->timestamp;

//for(*start_ptr=*tab_ptr;*start_ptr!='\t';*start_ptr++)
//for(i=0;i<strlen(start_ptr);i++)
//well->timestamp[i]=*start_ptr;
//strncpy(&well.timestamp[i],start_ptr,strlen(start_ptr)); 


						if( start_ptr != tab_ptr)
							start_ptr = tab_ptr;
							tab_ptr = strchr(start_ptr, '\t');
							if (tab_ptr != NULL) 
					         		*tab_ptr++ = '\0';
								else		exit(0);

char *tab_ptr2 = strchr(tab_ptr, '\n');
							if (tab_ptr2 != NULL) 
					         		*tab_ptr2 = '\0';


//char *new2=start_ptr;
strncpy(well->value,start_ptr,strlen(start_ptr));
//printf("%.2f\t", atof(well->value));
//for(*start_ptr=*tab_ptr;*start_ptr!='\t';*start_ptr++)
//for(i=0;i<strlen(start_ptr);i++)
//well.value[i]=*start_ptr;
//strncpy(&well.value[i],start_ptr,strlen(start_ptr));   	
 
						
						
strncpy(well->description,tab_ptr,strlen(tab_ptr));
//printf("%s \n", well->description);

//	printf("done\n");	
My402ListAppend(list,well);

		//printf("Data Entered into the element\n"); 
		}
   /*validate the input*/
if(!val1(well)) {printf("Operator error\n");exit(0);}
  if(!val2(well,fp)) {printf("Timestamp error\n");exit(0);}
      if(!val3(well)) { printf("Value error\n");exit(0);}
	if(!val4(well)) { printf("Description error\n");exit(0);}
		{printf("valid\n");
} 
//else
//	printf("Valid\n");
	
		
      /* if(fgets(buf,sizeof(buf),fp)==NULL){
        printf("Data Incorrect, please try again\n");	exit(1);}*/
	
	if(fp==NULL)
	printf("Can't read input, no parameters\n"); 
	
if(fp!=stdin)
fclose(fp);

} 


 


int main (int argc, char *argv[])
    {
	 My402List list;
	 memset(&list, 0, sizeof(My402List));
    	(void)My402ListInit(&list);
	//printf("In the main function\n");
	fp=stdin;
	if(argv[1]==NULL)
	printf("Can't proceed, put a file or enter digits\n"); 
	if(argc==3)
	fp = fopen(argv[2], "r"); 
	else
	if (argc==2) fp=stdin;
	else	exit(1);
	ReadInput(fp,&list,argv);
	SortInput(&list);	
	printf(" +-----------------+--------------------------+----------------+----------------+\n");
	printf(" |       Date      | Description              |         Amount |        Balance |\n");
	printf(" +-----------------+--------------------------+----------------+----------------+\n");	
	PrintStatement(&list);
	printf(" +-----------------+--------------------------+----------------+----------------+\n");	
		
	return 0;
    }  
 




