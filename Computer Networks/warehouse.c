/*
** server.c -- a stream socket server demo
*/
#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <errno.h>
#include <string.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <netdb.h>
#include <arpa/inet.h>
#include <sys/wait.h>
#include <signal.h>

#define PORT "3490" // the port users will be connecting to
#define BACKLOG 10 // how many pending connections queue will hold
#define MAXDATASIZE 100
#define hostname "localhost"
#define TCPPORT "21602"
#define WUDP311 "31602"
#define WUDP321 "32602"
#define S1UDP51 "5602"

void sigchld_handler(int s)
{
while(waitpid(-1, NULL, WNOHANG) > 0);
}

// get sockaddr, IPv4 or IPv6:
void *get_in_addr(struct sockaddr *sa)
{
if (sa->sa_family == AF_INET) {
return &(((struct sockaddr_in*)sa)->sin_addr);
}
return &(((struct sockaddr_in6*)sa)->sin6_addr);
}
int main(void)
	{
	int sockfd, new_fd,numbytes; // listen on sock_fd, new connection on new_fd
	struct addrinfo hints, *servinfo, *p;
	int buf;
	int i=0;
	int buffer1[MAXDATASIZE];
	struct sockaddr_storage their_addr; // connector's address information
	socklen_t sin_size;
	struct sockaddr_in sin;
	int addrlen = sizeof(sin);
	struct sigaction sa;
	socklen_t addr_len;
	int yes=1;
	char s[INET6_ADDRSTRLEN];
	int rv;
	int k=0;
	struct hostent *he;
	struct in_addr **addr_list;
	int j=0;
	int array[3];

	if ((he = gethostbyname(hostname)) == NULL) 
	{ // get the host info
		herror("gethostbyname");
		return 2;
	}
// print information about this host:
	printf("Phase 1: the central warehouse has TCP port number %s", TCPPORT);
	printf(" and  IP addresses: ");
	addr_list = (struct in_addr **)he->h_addr_list;
	for(i = 0; addr_list[i] != NULL; i++) 
		printf("%s ", inet_ntoa(*addr_list[i]));
	
	printf("\n");
	memset(&hints, 0, sizeof hints);
	hints.ai_family = AF_UNSPEC;
	hints.ai_socktype = SOCK_STREAM;
	hints.ai_flags = AI_PASSIVE; // use my IP
	if ((rv = getaddrinfo(NULL, TCPPORT, &hints, &servinfo)) != 0) 
	{
	fprintf(stderr, "getaddrinfo: %s\n", gai_strerror(rv));
	return 1;
	}
	// loop through all the results and bind to the first we can
	for(p = servinfo; p != NULL; p = p->ai_next) 
{
		if ((sockfd = socket(p->ai_family, p->ai_socktype,
		p->ai_protocol)) == -1) {
		perror("server: socket");
		continue;
					}
	if(getsockname(sockfd, (struct sockaddr *)&sin, &addrlen) == 0 &&
	   sin.sin_family == AF_INET &&
	   addrlen == sizeof(sin))
		//printf("local port number in use: %d\n", atoi(TCPPORT));
	
	if (setsockopt(sockfd, SOL_SOCKET, SO_REUSEADDR, &yes, sizeof(int)) == -1) 
	{
		perror("setsockopt");
		exit(1);
	}
	if (bind(sockfd, p->ai_addr, p->ai_addrlen) == -1) 
		{
		close(sockfd);
		perror("server: bind");
		continue;
		}
	break;
}
	if (p == NULL) 
	{
		fprintf(stderr, "server: failed to bind\n");
		return 2;
	}
	freeaddrinfo(servinfo); // all done with this structure
	if (listen(sockfd, BACKLOG) == -1) 
	{
		perror("listen");
		exit(1);
	}

	sa.sa_handler = sigchld_handler; // reap all dead processes
	sigemptyset(&sa.sa_mask);
	sa.sa_flags = SA_RESTART;
	if (sigaction(SIGCHLD, &sa, NULL) == -1) 
	{
		perror("sigaction");
		exit(1);
	}	
	//printf("Phase 1: the central warehouse has TCP port number %s and IP address %s\n", TCPPORT,inet_ntoa(*addr_list[i]));
	//printf("server: waiting for connections...\n");
	int temp[4][3];
	while(k<=3)
   { 											// main accept() loop
		sin_size = sizeof their_addr;
		new_fd = accept(sockfd, (struct sockaddr *)&their_addr, &sin_size);
		if (new_fd == -1) 
		{
		perror("accept");
		continue;
		}
		printf("Phase 1: The central warehouse received information from store# %d\n", k+1);
		/*inet_ntop(their_addr.ss_family,
		get_in_addr((struct sockaddr *)&their_addr), s, sizeof s);
		printf("server: got connection from %s\n", s);	*/
		if ((numbytes = recv(new_fd, buffer1, sizeof(buffer1), 0)) == -1) 
		{
	        	perror("recv");
			exit(1);
		}
		//buf[numbytes] = '\0';
		for(i=0;i<3;i++)
		{
				//printf("server: received data %d \n",buffer1[i]);
				temp[k][i]=buffer1[i];
	   	}	
	
	close(new_fd);
	k++;
	//exit(0);
    //}
close(new_fd); // parent doesn't need this}
   }
close(sockfd);
 /*for printing the vector received by the stores */
for(i=0;i<4;i++)
{
	/*for(j=0;j<3;j++)
	{
		printf("%d\t",temp[i][j]);
		
	}
	printf("\n");*/
}
		
 for(i=0;i<3;i++)
      {
	  array[i]=0;
	  for(j=0;j<4;j++)
		array[i]=array[i]+temp[j][i];
      }
 
	   /* printf("Vector values: <%d,%d,%d>\n",array[0],array[1],array[2]);
	printf("\n"); */
	for(i=0;i<3;i++)
	{
		if(array[i]<0)
			array[i]=-array[i]; 
		else if(array[i]>=0)
		 array[i]=0; 
	}

//printf("Vector values after modification: <%d,%d,%d>\n",array[0],array[1],array[2]);
	printf("End of Phase 1 for the central warehouse\n");
     /*Endof phase 1, printed vector */
	
//int sockfd;
//struct addrinfo hints, *servinfo, *p;
//int rv;
//int numbytes;
sleep(1);

printf("Phase 2: Warehouse has UDP port number %s  ", WUDP311);
for(i = 0; addr_list[i] != NULL; i++) 
		printf("and IP address %s \n", inet_ntoa(*addr_list[i]));


memset(&hints, 0, sizeof hints);
hints.ai_family = AF_UNSPEC;
hints.ai_socktype = SOCK_DGRAM;
if ((rv = getaddrinfo(hostname, S1UDP51, &hints, &servinfo)) != 0) {
fprintf(stderr, "getaddrinfo: %s\n", gai_strerror(rv));
return 1;
}
// loop through all the results and make a socket
for(p = servinfo; p != NULL; p = p->ai_next) {
if ((sockfd = socket(p->ai_family, p->ai_socktype,p->ai_protocol)) == -1) {
perror("talker: socket");
continue;
}
break;
}
if (p == NULL) {
fprintf(stderr, "talker: failed to bind socket\n");
return 2;
}


if ((numbytes = sendto(sockfd, array, sizeof(array), 0, p->ai_addr, p->ai_addrlen)) == -1) {
perror("talker: sendto");
exit(1);
}
freeaddrinfo(servinfo);
//if(numbytes>0)
/*printf("The central warehouse has UDP port number %s  ", WUDP311);
for(i = 0; addr_list[i] != NULL; i++) 
		printf("and IP address %s ", inet_ntoa(*addr_list[i]));*/
printf("Phase 2: Sending the truck-vector to outlet store store_1. The truck vector value is <%d,%d,%d>\n", array[0],array[1],array[2]); 
close(sockfd);

int buffer2[3];
memset(&hints, 0, sizeof hints);
hints.ai_family = AF_UNSPEC; // set to AF_INET to force IPv4
hints.ai_socktype = SOCK_DGRAM;
hints.ai_flags = AI_PASSIVE; // use my IP
//int yes=1;
if ((rv = getaddrinfo(NULL, WUDP321, &hints, &servinfo)) != 0) {
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
printf("Phase 2: The central warehouse has UDP port number %s  ", WUDP321);
for(i = 0; addr_list[i] != NULL; i++) 
		printf("and IP address %s \n", inet_ntoa(*addr_list[i]));
printf("Phase 2: The final truck-vector is received from the outlet store store_4,the truck-vector value is: <%d, %d, %d>\n", buffer2[0],buffer2[1],buffer2[2]);
printf("End of phase 2 for the central warehouse\n");
return 0;

}    

