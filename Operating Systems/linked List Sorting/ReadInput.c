void PrintStatement(My402List *list)
{
int i=0;
My402ListElem *elem=NULL;
EnteredData *well;
int num_items=My402ListLength(list);
well=(EnteredData*)elem->obj;
 for (elem=My402ListFirst(list);
    elem != NULL;elem=My402ListNext(list, elem))
	{
	PrintDate(list,elem,well);
	PrintDescription(list,elem,well); 
	PrintAmount(list,elem,well);  /*check for negatives*/
	PrintBalance(list,elem,well);
	//} /*compute balance*/

}  

int val1(EnteredData *well,FILE *fp)
{
   if(well->posneg[0] != '+') 
		if(well->posneg[0]!= '-')
			return 0;

	else  {return 1;
		printf("val 1 done\n");}
return 1;
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

int val3(EnteredData *well,FILE *fp)
{
float valcheck=atof(well->value);
float nod=strlen(well->value);
int i=0;
char start[20];
strcpy(start,well->value);
char * dpoint=strchr(start,'.');	
	if(valcheck>10000000u) {printf("Data enetered too large\n");return 0;}
		if(nod>10)    return 0;
		     /*if()
			{
			  *dpoint++;
			  *dpoint++;
			  *dpoint++;
		
					if(dpoint[0]!= '\t') 
					return 0; */
			


return 1;
}

int val4(EnteredData *well,FILE *fp)
{
char *endpoint;
if(well->description==NULL)
			
	return 0;
else	
	return 1;
} 


int ReadInput(FILE *fp, My402List *list,char* argv[])
{
	
	printf("Reading Input now\n");
	My402ListElem *Dd;
	EnteredData *well;
		int i=0;
		char buf[80];
		My402ListInit(list);				
		
		//printf("you have reached the end of the file\n");}
		 
			while(fgets(buf,sizeof(buf),fp)!=NULL)
				{
				
				well=(EnteredData*)malloc(sizeof(EnteredData));
				/*parsing*/	
				
						char *start_ptr = buf;
						char *tab_ptr = strchr(start_ptr, '\t');
						if (tab_ptr != NULL) 	
							*tab_ptr++ = '\0';	

if(strncpy(well->posneg,buf,strlen(buf)))
printf("%s\t", well->posneg);
//for(*start_ptr=buf[1];*start_ptr!=*tab_ptr;*start_ptr++)
//for(i=0;i<strlen(start_ptr);i++)
//well->posneg[i]=*start_ptr;
//if(strncpy(&well->posneg[i],start_ptr,strlen(start_ptr)))

								     					     	
							if( start_ptr != tab_ptr)
							start_ptr = tab_ptr;
							tab_ptr = strchr(start_ptr, '\t');
							if (tab_ptr != NULL) 
					         		*tab_ptr++ = '\0';
//char *new1=start_ptr;
if(strncpy(well->timestamp,start_ptr,strlen(start_ptr)))

//printf("%d", atoi(well->timestamp));
printf("%s\t",well->timestamp);
/*int timestamp;
timestamp=atoi(well->timestamp);
char *c=well->timestamp;

//for(*start_ptr=*tab_ptr;*start_ptr!='\t';*start_ptr++)
//for(i=0;i<strlen(start_ptr);i++)
//well->timestamp[i]=*start_ptr;
//strncpy(&well.timestamp[i],start_ptr,strlen(start_ptr)); 


						if( start_ptr != tab_ptr)
							start_ptr = tab_ptr;
							tab_ptr = strchr(start_ptr, '\t');
							if (tab_ptr != NULL) 
					         		*tab_ptr++ = '\0';
//char *new2=start_ptr;
if(strncpy(well->value,start_ptr,strlen(start_ptr)))
printf("%.2f\t", atof(well->value));
//for(*start_ptr=*tab_ptr;*start_ptr!='\t';*start_ptr++)
//for(i=0;i<strlen(start_ptr);i++)
//well.value[i]=*start_ptr;
//strncpy(&well.value[i],start_ptr,strlen(start_ptr));   	
 
						
						
if(strncpy(well->description,tab_ptr,strlen(tab_ptr)))
printf("%s \n", well->description);

	printf("done\n");	
My402ListAppend(list,well);

		printf("Data Entered into the element\n"); 
		}
   /*validate the input*/
if(val1(well, fp)) 
  if(val2(well,fp))
     if(!val3(well,fp))
	if(val4(well,fp))
		{printf("Validated\n");} 
else
	//printf("Invalid Data\n");
	
		
      /* if(fgets(buf,sizeof(buf),fp)==NULL){
        printf("Data Incorrect, please try again\n");	exit(1);}*/
	
	if(fp==NULL)
	printf("Can't read input, no parameters\n"); exit(0);
	

fclose(fp);

} 


