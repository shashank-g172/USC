listtest: 402project.o my402list.o
	gcc -o warmpup1 -g listtest.c my402list.o

listtest.o: 402project.c my402list.h
	gcc -g -c -Wall 402project.c

my402list.o: my402list.c my402list.h
	gcc -g -c -Wall my402list.c

clean:
	rm -f *.o warmup1

