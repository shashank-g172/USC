#include<stdio.h>
#include<string.h>
#include<pthread.h>
#include<stdlib.h>
#include <getopt.h>
#include<unistd.h>
#include<ctype.h>
#include<math.h>
#include"warmup2Header.h"
#include<time.h>
#include <sys/time.h>
#include <signal.h>

char buf[50]="\0";

double timeStampCalc(struct timeval time1,struct timeval time2)
{
	double ts=(double)(((time2.tv_sec-time1.tv_sec)*1000000)+(time2.tv_usec-time1.tv_usec))/1000;
	return ts;
}
//got from else where
void remSpaces(char *ch)
{
    char *ch2 = ch;
    int i,j=0;
    for(i=0;i<=strlen(ch);i++){
	ch2[j] = ch[i];
	j++;
        if(ch[i]==' '){
		 {
                  do ++i; while (ch[i]==' ');
                        --i;
                }
            
        }
    }
}
char* tokenDisplay(int count)
{
	if(count==1)
		return "token"; 
	return "tokens";
}
void usageDetails()
{
        /* print out usage informaiton, i.e. commandline syntax */
	printf("Usage : warmup2 [-lambda lambda] [-mu mu]\n[-r r] [-B B] [-P P] [-n num]\n[-t tsfile]\n");
        exit(1);
}
void negativePrint()
{
printf("Error -ve values not allowed\n");
}
void parseCommandLine(int argc, char **argv)
{
    int c;
    float tem1;
    char *temp;
   while (1) {
        int option_index = 0;
        static struct option long_options[] = {
            {"t",      required_argument, 0,  1 },
            {"lambda", required_argument, 0,  2 },
            {"r",      required_argument, 0,  3 },
            {"B",      required_argument, 0,  4 },
	    {"P",      required_argument, 0,  0 },
	    {"n",      required_argument, 0,  5 },
	    {"mu",     required_argument, 0,  6 }
 
        };

       c = getopt_long_only(argc, argv, "",
                 long_options, &option_index);
        if (c == -1)
            break;

       switch (c) {
        case 0:
        //printf("option %s", long_options[option_index].name);
	temp=optarg;
	tem1=atof(temp);
        if (tem1>0)
		{
			P=tem1;
		}
               else
		{
			exit(0);
		}
	break;
	case 1:
	//printf("option %s", long_options[option_index].name);
	temp=optarg;
        if (strlen(temp)>0)
		{
			
			fileName=temp;
			deterministic=0;
		}
               else
		{
			exit(0);
		}
           
	break;
	case 2:
	//printf("option %s", long_options[option_index].name);
	temp=optarg;
	tem1=atof(temp);
        if (tem1>0)
		{
			if((float)1/tem1>10)
				{
					lambda=0.1;
				}
			else
				{
					lambda=tem1;
				}
		
		}
               else
		{
			negativePrint();
			exit(0);
		}
	break;
	case 3:
	//printf("option %s", long_options[option_index].name);
	temp=optarg;
	tem1=atof(temp);
        if (tem1>0)
		{
			if((float)1/tem1>10)
				{
					r=0.1;
				}
			else
				{
					r=tem1;
				}
			
		}
               else
		{
			negativePrint();
			exit(0);
		}
	break;
	case 4:
	//printf("option %s", long_options[option_index].name);
	temp=optarg;
	tem1=atoi(temp);
        if (tem1>0)
		{
			B=tem1;
		}
               else
		{
			negativePrint();
			exit(0);
		}
	break;
	case 5:
	//printf("option %s", long_options[option_index].name);
	temp=optarg;
	tem1=atoi(temp);
        if (tem1>0)
		{
			num=tem1;
		}
               else
		{
			negativePrint();
			exit(0);
		}
	break;
	case 6:
	//printf("option %s", long_options[option_index].name);
	temp=optarg;
	tem1=atof(temp);
        if (tem1>0)
		{
			if((float)1/tem1>10)
				{
					mu=0.1;
				}
			else
				{
					mu=tem1;
				}
			
		}
               else
		{
			negativePrint();
			exit(0);
		}
	break;
   	default:
            printf("Error in command line\n");
		usageDetails();
	exit(0);
        }
    }
   if (optind < argc) {
        printf("Some args not recognized\n");
        while (optind < argc)
            printf("%s ", argv[optind++]);
        printf("\n");
	exit(0);
    }
}

void readFileHeader()
{
	char buf[50]="\0";
	if(fgets(buf,sizeof(buf),fp)!=NULL)
	{
		if(strlen(buf)<1)
			{
				printf("Error in input File\n");
				exit(0);	
			}
		num=atoi(buf);
	}
}
void generatePack(int *packetNo,float *interTime,int *tokenVal,float *serviceTime)
{
	*packetNo=countPackets;
	*interTime=(float)1/lambda;
	*tokenVal=P;
	*serviceTime=(float)1/mu;
}
void fileRead(int *packetNo,float *interTime,int *tokenVal,float *serviceTime)
{
if(fgets(buf,sizeof(buf),fp)!=NULL)
	{
	*packetNo=countPackets;
	if(!isdigit((char)buf[0]))
		{
			printf("Error in input File\n");
				exit(0);
		}
	remSpaces(buf);
	char *startptr=buf;
	char *tabptr=strchr(startptr,'\t');
	if(tabptr!=NULL)
		*tabptr++='\0';
	else
		{
		tabptr=strchr(startptr,' ');
		if(tabptr!=NULL)
			*tabptr++='\0';
		else
			{
				printf("Error in input File\n");
				exit(0);
			}
		}	
	*interTime=(float)atof(startptr)/1000;
        startptr=tabptr;
	tabptr=strchr(startptr,'\t');
	if(tabptr!=NULL)
		*tabptr++='\0'; 
	else
		{
		tabptr=strchr(startptr,' ');
		if(tabptr!=NULL)
			*tabptr++='\0';
		else
			{
				printf("Error in input File\n");
				exit(0);
			}
		}	
	*tokenVal=atoi(startptr);
	startptr=tabptr;
	tabptr=strchr(startptr,'\n');
	if(tabptr!=NULL)
		*tabptr++='\0'; 
	else
		{
		tabptr=strchr(startptr,' ');
		if(tabptr!=NULL)
			*tabptr++='\0';
		else
			{
				printf("Error in input File\n");
				exit(0);
			}
		}	
	*serviceTime=atof(startptr)/1000;
	}

}

