/*
** client.c -- a stream socket client demo
*/
#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <errno.h>
#include <string.h>
#include <netdb.h> 
#include <sys/types.h>
#include <netinet/in.h>
#include <sys/socket.h>
#include <arpa/inet.h>

#define PORT "3490" // the port client will be connecting to
#define MAXDATASIZE 100 // max number of bytes we can get at once
#define MAXBUFLEN 3 
#define S1UDP51 "5602"
#define TCPPORT "21602"
#define S1UDP61 "6602"
#define S1UDP71 "7602"
#define S1UDP81 "8602"
#define S2UDP91 "9602"
#define S2UDP111 "11602"
#define hostname "localhost"

// get sockaddr, IPv4 or IPv6:
void *get_in_addr(struct sockaddr *sa)
{
if (sa->sa_family == AF_INET) {
return &(((struct sockaddr_in*)sa)->sin_addr);
}
return &(((struct sockaddr_in6*)sa)->sin6_addr);
}
int main(int argc, char *argv[])
{
int sockfd, numbytes;
char buf[MAXDATASIZE];
socklen_t addr_len;
struct addrinfo hints, *servinfo, *p;
int rv;
int buffer1[3];
struct sockaddr_storage their_addr;
socklen_t sin_size;
struct sockaddr_in sin;
int addrlen = sizeof(sin);
char s[INET6_ADDRSTRLEN];
/*if (argc != 2) {
fprintf(stderr,"usage: client hostname\n");
exit(1);
}*/
char *buffer = NULL;
	
   int string_size,read_size;
	int i=0;
	int vector[3];
	 int m=0;
   FILE *handler = fopen("Store-1.txt","r+");
   int f;
   if (handler)
   {
       
       fseek(handler,0,SEEK_END);
       
       string_size = ftell (handler);
      
       rewind(handler);

       
       buffer = (char*) malloc (sizeof(char) * (string_size + 1) );
       
       //read_size = fread(buffer,sizeof(char),string_size,handler);
       
       //buffer[string_size+1] = '\0';
	
	while(fscanf(handler," %s %d", buffer, &f)!=EOF) {
 	 vector[m]=f;
	  m++;	
	}
	
	/*for(m=0;m<3;m++)
	{
	printf("%d\n", vector[m]);
        }*/
   
  
		

       if (string_size != read_size) {
           //something went wrong, throw away the memory and set
           //the buffer to NULL
           free(buffer);
           buffer = NULL;
        }
    }
memset(&hints, 0, sizeof hints);
hints.ai_family = AF_UNSPEC;
hints.ai_socktype = SOCK_STREAM;
if ((rv = getaddrinfo(hostname, TCPPORT, &hints, &servinfo)) != 0) {
fprintf(stderr, "getaddrinfo: %s\n", gai_strerror(rv));
return 1;
}
// loop through all the results and connect to the first we can
for(p = servinfo; p != NULL; p = p->ai_next) {
if ((sockfd = socket(p->ai_family, p->ai_socktype,
p->ai_protocol)) == -1) {
perror("client: socket");
continue;
}
if (connect(sockfd, p->ai_addr, p->ai_addrlen) == -1) {
close(sockfd);
perror("client: connect");
continue;
}
break;
}
if (p == NULL) {
fprintf(stderr, "client: failed to connect\n");
return 2;
}
inet_ntop(p->ai_family, get_in_addr((struct sockaddr *)p->ai_addr),
s, sizeof s);
char service[20];
struct hostent *he;
//printf("client: connecting to %s\n", s);
/*getnameinfo(p->ai_addr, p->ai_addrlen, hostname, sizeof hostname, service, sizeof service, 0);
//getsockname(hostname,(struct sockaddr*)&sin,&addrlen);  
int port;
port=ntohs(sin.sin_port); 
printf("port number = %s\n",service);
//printf("server: has TCP port number %s and IP address %s\n", service, s); 
//printf("store_1 has TCP port number %d and IP address %s\n", ,s);
freeaddrinfo(servinfo); // all done with this structure*/
//int s;
  
   
   /* We must put the length in a variable.              */

      /* Ask getsockname to fill in this socket's local     */
      /* address.                                           */
  /* if (getsockname(sockfd, &sin, &addr_len) == -1) {
      perror("getsockname() failed");
      return -1;
   }
   //printf("Local IP address is: %s\n", inet_ntoa(sin.sin_add r));
   printf("Local port is: %d\n", (int) ntohs(sin.sin_port));
*/
struct in_addr **addr_list;
if ((he = gethostbyname(hostname)) == NULL) 
	{ // get the host info
		herror("gethostbyname");
		return 2;
	}
// print information about this host:
	printf("Phase 1: store_1 has TCP port number %d", (int) ntohs(sin.sin_port));
	printf(" and  IP addresses: ");
	addr_list = (struct in_addr **)he->h_addr_list;
	for(i = 0; addr_list[i] != NULL; i++) 
		printf("%s \n", inet_ntoa(*addr_list[i]));
if (send(sockfd, vector, sizeof(vector), 0) == -1)
perror("send");
//for(i=0;i<m;i++)
printf("The outlet vector <%d,%d,%d> for store_1 has been sent to the central warehouse \n", vector[0],vector[1],vector[2]);
printf("End of Phase 1 for Store_1\n");
close(sockfd);
/*end of sending vector part of data, now receiving from warehouse */
//PHASE 2
//int sockfd;
//struct addrinfo hints, *servinfo, *p;
//int rv;
//int numbytes;
//struct sockaddr_storage their_addr;
//char buf[MAXBUFLEN];
//socklen_t addr_len;




//char s[INET6_ADDRSTRLEN];
memset(&hints, 0, sizeof hints);
hints.ai_family = AF_UNSPEC; // set to AF_INET to force IPv4
hints.ai_socktype = SOCK_DGRAM;
hints.ai_flags = AI_PASSIVE; // use my IP
int yes=1;
if ((rv = getaddrinfo(NULL, S1UDP51, &hints, &servinfo)) != 0) {
fprintf(stderr, "getaddrinfo: %s\n", gai_strerror(rv));
return 1;
}
// loop through all the results and bind to the first we can
for(p = servinfo; p != NULL; p = p->ai_next) {
if ((sockfd = socket(p->ai_family, p->ai_socktype,p->ai_protocol)) == -1) {
perror("listener: socket");
continue;
}

if (bind(sockfd, p->ai_addr, p->ai_addrlen) == -1) {
close(sockfd);
perror("listener: bind");
continue;
}
break;
}
if (p == NULL) {
fprintf(stderr, "listener: failed to bind socket\n");
return 2;
}
//inet_ntop(p->ai_family, get_in_addr((struct sockaddr *)p->ai_addr),s, sizeof s);
//printf("client: connecting to %s\n", s);
freeaddrinfo(servinfo);
//printf("listener: waiting to receive data from...\n");
addr_len = sizeof their_addr;
if ((numbytes = recvfrom(sockfd, buffer1, sizeof(buffer1) , 0, (struct sockaddr *)&their_addr, &addr_len)) == -1) {
printf("error\n");
perror("recvfrom");
exit(1);
close(sockfd);
}
//buffer1[numbytes] = '\0';
//if(numbytes>0)
//printf("numbytes= %d\n", numbytes);
printf("Phase 2: Store_1 has UDP port number %s  ", S1UDP51);
for(i = 0; addr_list[i] != NULL; i++) 
		printf("and IP address %s \n", inet_ntoa(*addr_list[i]));
printf("Phase 2: Store_1 received the truck-vector <%d,%d,%d>from the central warehouse\n", buffer1[0],buffer1[1],buffer1[2]);
close(sockfd); 

int vector1[3];
for(i=0;i<3;i++)
vector1[i]=vector[i]+buffer1[i];

/*for(i=0;i<3;i++) {
if(vector1[i]>=0) 
remaining[i]=0;
else if(vector1[i]<0)
remaining[i]=vector[i];
else if(vector1[i]=0)
remaining[i]=vector[i]; }
printf("Remaining <%d, %d, %d>\n", remaining[0],remaining[1],remaining[2]);*/



//printf("Vector 1 values <%d,%d,%d>\n", vector1[0],vector1[1],vector1[2]);


//Finished receiving, now sending to store 2




sleep(1);
printf("Phase 2: Store_1 has UDP port number %s  ", S1UDP61);
for(i = 0; addr_list[i] != NULL; i++) 
		printf("and IP address %s \n", inet_ntoa(*addr_list[i]));


printf("Phase 2: The updated truck-vector<%d,%d,%d> has been sent to store_2\n", vector1[0],vector1[1],vector1[2]);
printf("Phase 2: Store_1 updated outlet-vector is <%d,%d,%d>\n", vector1[0],vector1[1],vector1[2]);

memset(&hints, 0, sizeof hints);
hints.ai_family = AF_UNSPEC;
hints.ai_socktype = SOCK_DGRAM;
if ((rv = getaddrinfo(hostname, S2UDP91, &hints, &servinfo)) != 0) {
fprintf(stderr, "getaddrinfo: %s\n", gai_strerror(rv));
return 1;
}
// loop through all the results and make a socket
for(p = servinfo; p != NULL; p = p->ai_next) {
if ((sockfd = socket(p->ai_family, p->ai_socktype,p->ai_protocol)) == -1) {
perror("talker: socket");
continue;
}
if (setsockopt(sockfd, SOL_SOCKET, SO_REUSEADDR, &yes, sizeof(int)) == -1) 
	{
		perror("setsockopt");
		exit(1);
	}
/*if (bind(sockfd, p->ai_addr, p->ai_addrlen) == -1) {
close(sockfd);
perror("talker: bind");
continue;
}*/
break;
}
if (p == NULL) {
fprintf(stderr, "talker: failed to bind socket\n");
return 2;
}


if ((numbytes = sendto(sockfd, vector1, sizeof(vector1), 0, p->ai_addr, p->ai_addrlen)) == -1) {
perror("talker: sendto");
exit(1);
}
freeaddrinfo(servinfo);
//if(numbytes>0)

close(sockfd);

//end of sending to store 2



memset(&hints, 0, sizeof hints);
hints.ai_family = AF_UNSPEC; // set to AF_INET to force IPv4
hints.ai_socktype = SOCK_DGRAM;
hints.ai_flags = AI_PASSIVE; // use my IP
//int yes=1;
if ((rv = getaddrinfo(NULL, S1UDP71, &hints, &servinfo)) != 0) {
fprintf(stderr, "getaddrinfo: %s\n", gai_strerror(rv));
return 1;
}
// loop through all the results and bind to the first we can
for(p = servinfo; p != NULL; p = p->ai_next) {
if ((sockfd = socket(p->ai_family, p->ai_socktype,p->ai_protocol)) == -1) {
perror("listener: socket");
continue;
}

if (bind(sockfd, p->ai_addr, p->ai_addrlen) == -1) {
close(sockfd);
perror("listener: bind");
continue;
}
break;
}
if (p == NULL) {
fprintf(stderr, "listener: failed to bind socket\n");
return 2;
}
//inet_ntop(p->ai_family, get_in_addr((struct sockaddr *)p->ai_addr),s, sizeof s);
//printf("client: connecting to %s\n", s);
freeaddrinfo(servinfo);
//printf("listener: waiting to receive data from...\n");
addr_len = sizeof their_addr;
if ((numbytes = recvfrom(sockfd, buffer1, sizeof(buffer1) , 0, (struct sockaddr *)&their_addr, &addr_len)) == -1) {
printf("error\n");
perror("recvfrom");
exit(1);
close(sockfd);
}
//buffer1[numbytes] = '\0';
//if(numbytes>0)
//printf("numbytes= %d\n", numbytes);
printf("Phase 2: Store_1 has UDP port number %s  ", S1UDP71);
for(i = 0; addr_list[i] != NULL; i++) 
		printf("and IP address %s \n", inet_ntoa(*addr_list[i]));
printf("Phase 2: Truck-vector <%d,%d,%d>has been received from Store_4\n", buffer1[0],buffer1[1],buffer1[2]);
close(sockfd);

sleep(1);

int vector2[3];

for(i=0;i<3;i++)
vector2[i]=0+buffer1[i];

printf("Phase 2: Store_1 has UDP port number %s  ", S1UDP81);
for(i = 0; addr_list[i] != NULL; i++) 
		printf("and IP address %s \n", inet_ntoa(*addr_list[i]));

printf("Phase 2: The updated truck-vector<%d,%d,%d> has been sent to store_2\n", vector2[0],vector2[1],vector2[2]);
printf("Phase 2: Store_1 updated outlet-vector is <%d,%d,%d>\n", vector2[0],vector2[1],vector2[2]);


memset(&hints, 0, sizeof hints);
hints.ai_family = AF_UNSPEC;
hints.ai_socktype = SOCK_DGRAM;
if ((rv = getaddrinfo(hostname, S2UDP111, &hints, &servinfo)) != 0) {
fprintf(stderr, "getaddrinfo: %s\n", gai_strerror(rv));
return 1;
}
// loop through all the results and make a socket
for(p = servinfo; p != NULL; p = p->ai_next) {
if ((sockfd = socket(p->ai_family, p->ai_socktype,p->ai_protocol)) == -1) {
perror("talker: socket");
continue;
}
if (setsockopt(sockfd, SOL_SOCKET, SO_REUSEADDR, &yes, sizeof(int)) == -1) 
	{
		perror("setsockopt");
		exit(1);
	}
/*if (bind(sockfd, p->ai_addr, p->ai_addrlen) == -1) {
close(sockfd);
perror("talker: bind");
continue;
}*/
break;
}
if (p == NULL) {
fprintf(stderr, "talker: failed to bind socket\n");
return 2;
}


if ((numbytes = sendto(sockfd, vector2, sizeof(vector2), 0, p->ai_addr, p->ai_addrlen)) == -1) {
perror("talker: sendto");
exit(1);
}
freeaddrinfo(servinfo);
//if(numbytes>0)

close(sockfd);

//end of sending to store 2 phase 2

printf("Ending of Phase 2 for store_1\n");

return 0; 
}






