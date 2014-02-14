The Java code uses 3 programs, each which is called on by the other. The SearchMaze.java is the name of the main program, which uses Grid.java to act as a cell in the maze. The last one is the heuristic comparator for the A* and beam algorithm.

The arguments can be supplied in any order, except "search" which has to be the first argument passed. The program only takes in the type of algorithm in the first argument. 

On the last version of this code, there was a slight bug with the beam search. It printed a path, even though there was none with a limited beam value, which is erroneous. 

The grader will have to create an output file, and the absolute path needs to be given for testing the input and the output files.  

Since this is a Java file, there is no makefile. Please use javac -classpath (searchmaze.java) (Grid.java) (HeuristicComparator.java).

Then please issue the java SearchMaze.java line, and add in your arguments. It worked fine on nunki the last time it was tested.  If that fails as well, please try opening it on Eclipse Helios, or Juno.It was developed on the IDE, and it should run fine, as long as the input and the output files are given in the right order. (Once again, there is no output file, please create one while grading)

The output does not display in accordance with the format specified on notepad. Please use a text editor like Sublime text or Notepad++.