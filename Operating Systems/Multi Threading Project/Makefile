warmup2: warmup2.o my402list.o warmup2Util.o
	gcc -o warmup2 -g -pthread my402list.o warmup2.o warmup2Util.o -lm

warmup2.o: warmup2.c warmup2Header.h my402list.h
	gcc -g -c -Wall -pthread warmup2.c  

warmup2Util.o: warmup2Util.c warmup2Header.h my402list.h
	gcc -g -c -Wall warmup2Util.c   

my402list.o: my402list.c my402list.h
	gcc -g -c -Wall my402list.c

clean:
	rm -f *.o warmup2


