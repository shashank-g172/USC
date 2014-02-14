#include<stdio.h>
#include<string.h>
#include<pthread.h>
#include<stdlib.h>
#include<unistd.h>
#include<ctype.h>
#include<math.h>
#include"my402list.h"
#include<time.h>
#include <sys/time.h>
#include <signal.h>
#include"warmup2Header.h"
pthread_t tid[3];
int bucket=0;
pthread_mutex_t lock;
pthread_cond_t cond_var;
int B=10;
float r=1.5;
float lambda=0.5;
float mu=0.35;
int num=20;
int P=3;
char* fileName;
int serverwait=0;
int tokenCount=0;
My402List q1,q2;
int droppedPackets=0;
int droppedTockens=0;
float totalTimeQ1=0;
float totalTimeQ2=0;
float totalTimeSystem=0;
float totalTimeSystemSq=0;
float totalInterArrivalTime=0;
float totalServiceTime=0;
int countPackets=0;
int q1PacketCount=0;
int q2PacketCount=0;
int servicePacketCount=0;
int deterministic=1;
int term=0,term2=0;
struct timeval t1, t2, t3, t4, t5, t6, t7, t8, t9;
struct timeval end;
FILE *fp=NULL;

void MoveQ1toQ2()
{
Packet *p;
pthread_mutex_lock(&lock);
if(!My402ListEmpty(&q1))
	{
		My402ListElem *elem=My402ListFirst(&q1);
		p=elem->obj;
		if(bucket >= p->tokenVal)
			{
			My402ListElem *elem=My402ListFirst(&q1);
			p=elem->obj;
			gettimeofday(&t4, NULL);
			bucket =bucket-p->tokenVal;
			float tempQ1Avg=timeStampCalc(p->q1ArrivalTime,t4);
			totalTimeQ1=totalTimeQ1+tempQ1Avg;
			pthread_mutex_unlock(&lock);
			printf("%012.3fms: p%d leaves Q1, time in Q1 = %.3fms, token bucket now has %d %s\n",
			timeStampCalc(t1,t4),
			p->packetNo,
			tempQ1Avg,
			bucket,
			tokenDisplay(bucket));
			pthread_mutex_lock(&lock);
			q1PacketCount++;
			My402ListAppend(&q2,p);
			gettimeofday(&t4, NULL);
			p->q2ArrivalTime=t4;
			pthread_mutex_unlock(&lock);
			printf("%012.3fms: p%d enters Q2\n",timeStampCalc(t1,t4),p->packetNo);
			pthread_mutex_lock(&lock);
			My402ListUnlink(&q1, elem);	
			pthread_cond_broadcast(&cond_var);
			}		
	}
pthread_mutex_unlock(&lock);
}
void* TokenBucketHandler(void *arg)
{    
while(1)
	{
	usleep (((double)(1/r)*1000000));
 	gettimeofday(&t2, NULL);
	pthread_mutex_lock(&lock);
	tokenCount =tokenCount +1;
	if(bucket>=B)
		{
		pthread_mutex_unlock(&lock);
		printf( "%012.3fms: token t%d arrives, dropped\n",timeStampCalc(t1,t2), tokenCount);
		droppedTockens++;
		}	
	else
		{							             
	bucket= bucket+1;
	pthread_mutex_unlock(&lock);
	
	printf( "%012.3fms: token t%d arrives, token bucket now has %d %s\n",timeStampCalc(t1,t2),tokenCount,bucket,tokenDisplay(bucket));
		}
						              
	MoveQ1toQ2();
	pthread_mutex_lock(&lock);
	if(My402ListEmpty(&q1) && countPackets==num && term2==1)
		{
			term=1;
			pthread_cond_broadcast(&cond_var);
			pthread_mutex_unlock(&lock);
			return NULL;
		}
	pthread_mutex_unlock(&lock);
	}
	return NULL;
}

void* Q1Handler(void *arg)
{
Packet *p;
float interTime,serviceTime;
int packetNo,tokenVal;
if(deterministic==0)
	{
		readFileHeader();
	}
gettimeofday(&t1, NULL);
t2=t1;
printf( "%012.3fms: emulation begins\n",timeStampCalc(t1,t2));
pthread_mutex_lock(&lock);
while(countPackets<num)
{	
	gettimeofday(&t8,NULL);
	countPackets++;
	pthread_mutex_unlock(&lock);
	if(deterministic==0)
		{
		fileRead(&packetNo,&interTime,&tokenVal,&serviceTime);
		}
	else
		{
		generatePack(&packetNo,&interTime,&tokenVal,&serviceTime);
		}
	gettimeofday(&t9,NULL);
	double tempTime=(double)interTime*1000000-(((t9.tv_sec-t8.tv_sec)*1000000)+(t9.tv_usec-t8.tv_usec));
	gettimeofday(&t7,NULL);
	usleep((double)tempTime);
	gettimeofday(&t3, NULL);
	pthread_mutex_lock(&lock);
	if(B<tokenVal)
		{
		printf("%012.3fms: p%d arrives, needs %d %s, dropped\n",timeStampCalc(t1,t3),packetNo,tokenVal,tokenDisplay(tokenVal));
		droppedPackets++;
		pthread_mutex_unlock(&lock);
		continue;	
		}
	pthread_mutex_unlock(&lock);
	float tempInterArrivalAvg=timeStampCalc(t7,t3);
	totalInterArrivalTime=totalInterArrivalTime+tempInterArrivalAvg;
	printf("%012.3fms: p%d arrives, needs %d %s, inter-arrival time = %.3fms\n",timeStampCalc(t1,t3),packetNo,tokenVal,tokenDisplay(tokenVal),
							tempInterArrivalAvg);
	struct timeval temp=t3;
	//Packet Creation
	gettimeofday(&t3, NULL);
	p=(Packet*)malloc(sizeof(Packet));
	p->tokenVal=tokenVal;
	p->packetNo=packetNo;
	p->arrivalTime=temp;
	p->q1ArrivalTime=t3;
	p->serviceTime=serviceTime;
	pthread_mutex_lock(&lock);
	My402ListAppend(&q1,p);	
	printf("%012.3fms: p%d enters Q1\n",timeStampCalc(t1,t3),packetNo);						
	pthread_mutex_unlock(&lock);
	MoveQ1toQ2();
	pthread_mutex_lock(&lock);
		if(My402ListEmpty(&q1) && countPackets==num)
		{
			term=1;
			term2=1;
			pthread_cond_broadcast(&cond_var);
			pthread_mutex_unlock(&lock);
			return NULL;
		}
	pthread_mutex_unlock(&lock);
    	}
pthread_mutex_unlock(&lock);
term2=1; 	
return NULL ;
}

void* Server(void *arg)
{
Packet *p;
while(1)
	{
		pthread_mutex_lock(&lock);
		if(My402ListEmpty(&q2))
			{
				serverwait=1;
				pthread_cond_wait(&cond_var,&lock);
				pthread_mutex_unlock(&lock);	
			}
		else
			{
				serverwait=0;
				My402ListElem *elem=My402ListFirst(&q2);
				p=elem->obj;
				My402ListUnlink(&q2, elem);
				gettimeofday(&t5, NULL);
				float tempQ2Avg=timeStampCalc(p->q2ArrivalTime,t5);
				totalTimeQ2=totalTimeQ2+tempQ2Avg;
				q2PacketCount++;
				pthread_mutex_unlock(&lock);
				printf("%012.3fms: p%d begin service as S, time in Q2 = %.3fms\n",
				timeStampCalc(t1,t5),
				p->packetNo,
				tempQ2Avg);
				pthread_mutex_lock(&lock);
				double serviceTime=p->serviceTime;
				gettimeofday(&t6, NULL);
				pthread_mutex_unlock(&lock);
				usleep((double)serviceTime*1000000);
				pthread_mutex_lock(&lock);
				gettimeofday(&t5, NULL);
				float tempSysAvg=timeStampCalc(p->arrivalTime,t5);
				float tempServAvg=timeStampCalc(t6,t5);
				totalTimeSystem=totalTimeSystem+tempSysAvg;
				totalTimeSystemSq=totalTimeSystemSq +(tempSysAvg*tempSysAvg);
				totalServiceTime=totalServiceTime+tempServAvg;
				servicePacketCount++;
				pthread_mutex_unlock(&lock);
				printf("%012.3fms: p%d departs from S, service time = %.3fms time in system = %.3fms\n",
				timeStampCalc(t1,t5),
				p->packetNo,
				tempServAvg,
				tempSysAvg);
				free(p);
			}
		if(term==1 && My402ListEmpty(&q2))
			{
				return NULL;
			}
		
	}
return NULL;
}

void intHandler()
{
pthread_cancel(tid[1]);
pthread_cancel(tid[0]);
pthread_mutex_lock(&lock);
My402ListUnlinkAll(&q1);
My402ListUnlinkAll(&q2);
if(serverwait==1)
	pthread_cancel(tid[2]);
else
	term=1;
pthread_mutex_unlock(&lock);
}
int main(int argc,char *argv[])
{
 	parseCommandLine(argc,argv);
	
	printf("Emulation Parameters:\n");
	if(deterministic==1)
		{
		printf("lambda = %g\n",lambda);
		printf("mu = %g\n",mu);
		}
	printf("r = %g\n",r);
	printf("B = %d\n",B);
	if(deterministic==1)
		{
		printf("P = %d\n",P);
		printf("number to arrive = %d\n",num);
		}
	if(deterministic==0)
		{
		printf("tsfile = %s\n",fileName);
		}
    	int err=0;
    	My402ListInit(&q1);
    	My402ListInit(&q2);
    	
    		
	signal(SIGINT, intHandler);
    	
	if( deterministic==0)
	{
    		fp=fopen(fileName, "r");
		if (fp == NULL) 
		{
			fprintf(stderr,"Can't open input file\n");
			exit(1);
		}		
	}
	if (pthread_mutex_init(&lock, NULL) != 0)
    	{
        	printf("\n mutex init failed\n");
        	return 1;
    	}
    	if (pthread_cond_init(&cond_var, NULL) != 0)
    	{
        printf("\n cond init failed\n");
        return 1;
    	}
        err = pthread_create(&(tid[0]), NULL, &TokenBucketHandler, NULL);
	if (err != 0)
  		printf("\ncan't create thread :[%s]", strerror(err));
        err = pthread_create(&(tid[1]), NULL, &Q1Handler, NULL);
        if (err != 0)
        	printf("\ncan't create thread :[%s]", strerror(err));
	err = pthread_create(&(tid[2]), NULL, &Server, NULL);
        if (err != 0)
        	printf("\ncan't create thread :[%s]", strerror(err));
	pthread_join(tid[2], NULL);
	pthread_join(tid[1], NULL);
	pthread_join(tid[0], NULL);
	pthread_mutex_destroy(&lock);
	 gettimeofday(&end, NULL);
	float totalSimulationTime=timeStampCalc(t1,end);
	printf("\n\tStatistics:");
        float temp=totalInterArrivalTime/q1PacketCount;
	if(totalInterArrivalTime==0)
		temp=0;
        printf("\n\n\taverage packet inter-arrival time = %.6g",temp/1000);
	if(totalServiceTime==0)
		temp=0;
	else
		temp=totalServiceTime/servicePacketCount;
        printf("\n\taverage packet service time = %.6g",temp/1000);
	if(totalTimeQ1==0)
		temp=0;
	else
		temp=totalTimeQ1/totalSimulationTime;
        printf("\n\n\taverage number of packets in Q1 = %.6g",temp);
	if(totalTimeQ2==0)
		temp=0;
	else
		temp=totalTimeQ2/totalSimulationTime;	
        printf("\n\taverage number of packets in Q2 = %.6g",temp);
	if(totalTimeQ2==0)
		temp=0;
	else
		temp=totalServiceTime/totalSimulationTime;	
        printf("\n\taverage number of packets at S = %.6g",temp);
	if(totalTimeSystem==0)
		temp=0;
	else
		temp=totalTimeSystem/servicePacketCount;
        printf("\n\n\taverage time a packet spent in system = %.6g",temp/1000);
	if(totalTimeSystem==0)
		temp=0;
	else
		temp=sqrtf(((totalTimeSystemSq)-((totalTimeSystem*totalTimeSystem)/servicePacketCount))/servicePacketCount);
        printf("\n\tstandard deviation for time spent in system = %.6g",temp/1000);
	if(droppedTockens==0)
		temp=0;
	else
	        temp=(float)droppedTockens/tokenCount;
        printf("\n\n\ttoken drop probability = %.6g",temp);
	if(droppedPackets==0)
		temp=0;
	else
		temp=(float)droppedPackets/countPackets;
        printf("\n\tpacket drop probability = %.6g\n",temp);

	if(fp!=NULL)
	fclose(fp);
	return 0;
	
}

