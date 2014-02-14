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
#define MAXDATASIZE 100
#define hostname "localhost"
//#define MAXDATASIZE 100 // max number of bytes we can get at once
#define S3UDP131 "13602"
#define TCPPORT "21602"
#define S4UDP171 "17602"
#define S3UDP141 "14602"
#define S3UDP151 "15602"
#define S4UDP191 "19602"
#define S3UDP161 "16602"

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
socklen_t sin_size;
struct sockaddr_in sin;
struct in_addr **addr_list;
struct hostent *he;
int addrlen = sizeof(sin);
struct sockaddr_storage their_addr;
char buf[MAXDATASIZE];
struct addrinfo hints, *servinfo, *p;
int rv;
socklen_t addr_len;
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
   FILE *handler = fopen("Store-3.txt","r+");
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
//struct in_addr **addr_list;
//struct hostent *he;
if ((he = gethostbyname(hostname)) == NULL) 
	{ // get the host info
		herror("gethostbyname");
		return 2;
	}
// print information about this host:
	printf("Phase 1: store_3 has TCP port number %d", (int) ntohs(sin.sin_port));
	printf(" and  IP addresses: ");
	addr_list = (struct in_addr **)he->h_addr_list;
	for(i = 0; addr_list[i] != NULL; i++) 
		printf("%s \n", inet_ntoa(*addr_list[i]));
//printf("client: connecting to %s\n", s);

freeaddrinfo(servinfo); // all done with this structure
if (send(sockfd, vector, sizeof(vector), 0) == -1)
perror("send");
printf("The outlet vector <%d,%d,%d> for store_3 has been sent to Store_4 \n", vector[0],vector[1],vector[2]);
printf("End of Phase 1 for Store_3\n");

close(sockfd);

//end of sending to the Warehouse, begin receiving

int buffer1[3];
memset(&hints, 0, sizeof hints);
hints.ai_family = AF_UNSPEC; // set to AF_INET to force IPv4
hints.ai_socktype = SOCK_DGRAM;
hints.ai_flags = AI_PASSIVE; // use my IP
//int yes=1;
if ((rv = getaddrinfo(NULL, S3UDP131, &hints, &servinfo)) != 0) {
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
printf("Phase 2: Store_3 has UDP port number %s and IP address ", S3UDP131);
addr_list = (struct in_addr **)he->h_addr_list;
for(i = 0; addr_list[i] != NULL; i++) 
		printf("%s \n", inet_ntoa(*addr_list[i]));
if ((numbytes = recvfrom(sockfd, buffer1, sizeof(buffer1) , 0, (struct sockaddr *)&their_addr, &addr_len)) == -1) {
printf("error\n");
perror("recvfrom");
exit(1);
close(sockfd);
}
//buffer1[numbytes] = '\0';
//if(numbytes>0)
//printf("numbytes= %d\n", numbytes);
printf("Phase 2: Store_3 received the truck-vector <%d,%d,%d>from Store_2\n", buffer1[0],buffer1[1],buffer1[2]);


int vector1[3],rem[3];
for(i=0;i<3;i++){
vector1[i]=buffer1[i]+vector[i];
if(vector1[i]<0) vector1[i]=0; }

for(i=0;i<3;i++){
rem[i]=buffer1[i]+vector[i];
if(rem[i]>0) rem[i]=0; }

//printf( " Rem: <%d, %d, %d> \n", rem[0],rem[1],rem[2]); 
printf("Phase 2: Store_3 has UDP port number %s  ", S3UDP141);
for(i = 0; addr_list[i] != NULL; i++) 
		printf("and IP address %s \n", inet_ntoa(*addr_list[i]));
//printf("Phase 2: Store_3 received the truck-vector <%d,%d,%d>from store_2\n", buffer1[0],buffer1[1],buffer1[2]);
printf("Phase 2:The updated  truck vector  <%d,%d,%d> has been sent to Store_4\n", vector1[0],vector1[1],vector1[2]);
printf("Phase 2: Store_3 updated outlet-vector is <%d,%d,%d>\n", vector1[0],vector1[1],vector1[2]);

close(sockfd); 

//end of receiving from store 2, now sending to store 4

memset(&hints, 0, sizeof hints);
hints.ai_family = AF_UNSPEC;
hints.ai_socktype = SOCK_DGRAM;
if ((rv = getaddrinfo(hostname, S4UDP171, &hints, &servinfo)) != 0) {
fprintf(stderr, "getaddrinfo: %s\n", gai_strerror(rv));
return 1;
}
// loop through all the results and make a socket
for(p = servinfo; p != NULL; p = p->ai_next) {
if ((sockfd = socket(p->ai_family, p->ai_socktype,p->ai_protocol)) == -1) {
perror("talker: socket");
continue;
}
/*if (bind(sockfd, p->ai_addr, p->ai_addrlen) == -1) {
close(sockfd);
perror("listener: bind");
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

close(sockfd);

//end of phase 2 part 1

int buffer2[3];
memset(&hints, 0, sizeof hints);
hints.ai_family = AF_UNSPEC; // set to AF_INET to force IPv4
hints.ai_socktype = SOCK_DGRAM;
hints.ai_flags = AI_PASSIVE; // use my IP
//int yes=1;
if ((rv = getaddrinfo(NULL, S3UDP151, &hints, &servinfo)) != 0) {
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
if ((numbytes = recvfrom(sockfd, buffer2, sizeof(buffer2) , 0, (struct sockaddr *)&their_addr, &addr_len)) == -1) {
printf("error\n");
perror("recvfrom");
exit(1); 
close(sockfd);
}
printf("Phase 2: Store_3 has UDP port number %s  ", S3UDP151);
for(i = 0; addr_list[i] != NULL; i++) 
		printf("and IP address %s \n", inet_ntoa(*addr_list[i]));
printf("Phase 2: Store_3 received the truck-vector <%d,%d,%d>from Store_2\n", buffer2[0],buffer2[1],buffer2[2]);

int buffer3[3];

for(i=0;i<3;i++)
buffer3[i]=buffer2[i]+rem[i];

printf("Phase 2: Store_3 has UDP port number %s  ", S3UDP161);
for(i = 0; addr_list[i] != NULL; i++) 
		printf("and IP address %s \n", inet_ntoa(*addr_list[i]));

//printf("Stuff to send : <%d,%d,%d>from Store_1\n", buffer3[0],buffer3[1],buffer3[2]);

memset(&hints, 0, sizeof hints);
hints.ai_family = AF_UNSPEC;
hints.ai_socktype = SOCK_DGRAM;
if ((rv = getaddrinfo(hostname, S4UDP191, &hints, &servinfo)) != 0) {
fprintf(stderr, "getaddrinfo: %s\n", gai_strerror(rv));
return 1;
}
// loop through all the results and make a socket
for(p = servinfo; p != NULL; p = p->ai_next) {
if ((sockfd = socket(p->ai_family, p->ai_socktype,p->ai_protocol)) == -1) {
perror("talker: socket");
continue;
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


if ((numbytes = sendto(sockfd, buffer3, sizeof(buffer3), 0, p->ai_addr, p->ai_addrlen)) == -1) {
perror("talker: sendto");
exit(1);
}
freeaddrinfo(servinfo);
close(sockfd);

printf("Phase 2: The updated  truck vector  <%d,%d,%d> has been sent\n", buffer3[0],buffer3[1],buffer3[2]);
printf("Phase 2: Store_3 updated outlet-vector is <%d,%d,%d>\n", buffer3[0],buffer3[1],buffer3[2]);

printf("End of phase 2 for Store_3\n");


return 0;
}
	
