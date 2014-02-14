#ifndef _WARMUP2HEADER_H_
#define _WARMUP2HEADER_H_

#include<time.h>
#include<sys/time.h>
#include<stdio.h> 
extern int B;
extern float r;
extern float lambda;
extern float mu;
extern int num;
extern int P;
extern int countPackets;
extern FILE *fp;
extern char* fileName;
extern int deterministic;
extern double timeStampCalc(struct timeval,struct timeval);
extern char* tokenDisplay(int);
extern void usageDetails();
extern void parseCommandLine(int,char**);
extern void readFileHeader();
extern void generatePack(int *,float *,int *,float *);
extern void fileRead(int *,float *,int *,float *);
typedef struct packettag
{
int tokenVal;
float serviceTime;
struct timeval arrivalTime;
struct timeval q1ArrivalTime;
struct timeval q2ArrivalTime;
int packetNo;
}Packet;

#endif
