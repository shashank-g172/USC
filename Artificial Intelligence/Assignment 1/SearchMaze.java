import java.io.BufferedReader;

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;

import java.util.Collections;
import java.util.Iterator;
import java.util.LinkedList;
import java.util.PriorityQueue;

import java.util.Stack;

public class SearchMaze{


	private static final String LINE_BREAK = "\n";

	int beamValue =50 ;

	Grid[][] grid = new Grid[1000][1000];
	private Grid startNode;
	private Grid goalNode;
	//private Grid mudNode;

	public int Mwidth,Mheight;
	int x;
	int y;
	char c;
	char[][] arr;
	int time;
	String status;
	float speed = (float) 2.0;
	boolean flag;

	private String inputFile;
	private String outputFile;

	public String stripdigits(String input){
		String intValue = input.replaceAll("[a-zA-Z]", "");
		//System.out.println(intValue);

		return intValue;


	}

	public void setbeam(int beamValue)
	{
		this.beamValue=beamValue;

	}

	public void setoutput(String outputFile)
	{
		this.outputFile=outputFile;
	}

	public void setSpeed(float speed)
	{
		this.speed=speed;
	}

	public void createMazeGrid()

	{
		this.arr=new char[100][100];
		try{
			// Open the file that is the first 
			// command line parameter
			File inputFile=new File(this.inputFile);

			//	BufferedReader br = new BufferedReader(new InputStreamReader(in));
			BufferedReader br = new BufferedReader(new FileReader(inputFile));
			String strLine;

			//	char wall='*';
			char start='S';char goal='G';//char path=' ';

			//Read File Line By Line
			int j=0;
			while ((strLine = br.readLine()) != null)  
			{
				//System.out.println(strLine);
				if(j==0){
					this.Mwidth=Integer.parseInt(strLine.substring(6));
					//		System.out.println(this.Mwidth);
				}
				else if(j==1){
					this.Mheight=Integer.parseInt(strLine.substring(7));
					//	System.out.println(this.Mheight);
				}
				else
				{
					for(int k=0;k<strLine.length();k++){

						char charAt = strLine.charAt(k);
						this.arr[j-2][k]=charAt;

						Grid newGrid = new Grid(j-2, k, charAt);
						this.grid[j-2][k]=newGrid;

						if(charAt==start)  
						{
							startNode = newGrid;

						}
						/*else if(charAt==mud)  
						{
							/*Grid goalGrid = new Grid(j-2, k, c);
							this.grid[j-2][k]=goalGrid;*/
						//mudNode = newGrid;
						//}
						else if(charAt==goal)  
						{
							/*Grid goalGrid = new Grid(j-2, k, c);
							this.grid[j-2][k]=goalGrid;*/
							goalNode=newGrid;
						}
					}
				}

				j++;
			}   
			br.close();
			for(int l=0;l<this.Mheight;l++){
				for(int k=0;k<this.Mwidth;k++){
					Grid grid2 =this.grid[l][k];
					if(l>0)
						grid2.setNorth(this.grid[l-1][k]);
					if(k+1<Mwidth)
						grid2.setEast(this.grid[l][k+1]);
					if(l+1<Mheight)
						grid2.setSouth(this.grid[l+1][k]);
					if(k>0)
						grid2.setWest(this.grid[l][k-1]);

					//System.out.println("x: " + l + ",y: "+ k + ",c:" + grid2.getC());
					//System.out.println("----North: " + grid2.goNorth() + "::: South: " + grid2.goSouth() + " ::: East:" + grid2.goEast() + ":::: West:: " + grid2.goWest());
				}

			}
		} catch(Exception e){
			System.out.println("error in file parsing");
			e.printStackTrace();
			this.time=0; //print command line arguments, (figure out how)
			//print command line arguments, (figure out how)
		}
	}	


	public static void main(String[] argv) throws IOException 
	{
		long startTime = System.currentTimeMillis();
		SearchMaze searchMaze = new SearchMaze();

		String searchAlg = argv[0];

		for(int d=1; d<argv.length;d++)
		{
			String args = argv[d];
			if(args.equals("-s")) {
				searchMaze.setSpeed(Integer.parseInt(argv[d+1]));
			}
			else if(args.equals("-k")){
				searchMaze.setbeam(Integer.parseInt(argv[d+1]));

			}else if(args.equals("-i")){
				searchMaze.setInputFile(argv[d+1]);
			}
			else if(args.equals("-o")){
				searchMaze.setoutput(argv[d+1]);
			}
			long endTime   = System.currentTimeMillis();
			long totalTime = endTime - startTime;
			//System.out.println(totalTime);
		}


		//searchMaze.writeFile();
		//Create maze grid
		searchMaze.createMazeGrid();

		//Execute the algorithm based on the argument type
		if(searchAlg.equals("BFS")){
			searchMaze.BFSSearch();
		}else if(searchAlg.equals("DFS")){
			searchMaze.DFSSearch();
		}else  if(searchAlg.equals("Astar")){
			searchMaze.AstarSearch();
		}
		else  if(searchAlg.equals("Beam")){
			searchMaze.BeamSearch();
		}

	}



	private void BeamSearch() throws IOException {
		PriorityQueue<Grid> open =new PriorityQueue<Grid>(1000, new HeuristicComparator());
		//	Queue<Grid> closed =new LinkedList<Grid>();

		open.add(startNode);
		startNode.setVisited(true);
		startNode.setSpeed(speed);
		startNode.setTotalLen(0f);
		startNode.manDistance = Math.abs((goalNode.getX()-startNode.getX()) + (goalNode.getY()-startNode.getY()))/startNode.getSpeed();
		startNode.setTotalHeuristic(startNode.getTotalLen()+startNode.getManDist());
		Grid end = this.goalNode;
		startNode.setBeamValue(beamValue);
		
		//startNode= open.poll();
		//System.out.println("x" + end.getX() + "y"  +end.getY());
		int count=1;
		//	int ManDist=0;
		int endingX=0;
		int endingY=0;
		StringBuffer astar= new StringBuffer();
		File outputFile =  new File(this.outputFile);
		BufferedWriter writer = new BufferedWriter(new FileWriter(outputFile));
		//	int T_ManDist=0;
		Grid currentGrid=null;

		astar.append("--------------------------------------------------------------------------" +LINE_BREAK);
		astar.append("Search Log" +LINE_BREAK);	
		while(!open.isEmpty()) 
		{
			//if(count<=100)
				astar.append("Iteration = "+count +LINE_BREAK);
			currentGrid = open.remove();
			currentGrid.speed= speed;
			currentGrid.beamValue=beamValue;
			int counterChild=0; //inverse= 1/(currentGrid.getSpeed());
			//System.out.println("Number of iterations"  +count);
			//if(count<=100)
				astar.append("Current Node : x = "+currentGrid.getX()+" y = "+currentGrid.getY()+" speed = "+currentGrid.getSpeed()+" g =" +currentGrid.getTotalLen()+ " f = "  +currentGrid.getTotalHeuristic() +LINE_BREAK);

			count++;


			if(currentGrid.getC() ==(goalNode.getC())){
				//System.out.println(currentGrid);

				//System.out.println("Path Length" + open.size());
				astar.append("Goal node found");
				break;
				//writer.close();
				//return currentGrid;
			}

			Grid goNorth=currentGrid.goNorth();
			Grid goEast=currentGrid.goEast();
			Grid goSouth=currentGrid.goSouth();
			Grid goWest=currentGrid.goWest();

			//if(count<=100) 
			astar.append("Child List:");
			Grid northGrid = this.grid[goNorth.getX()][goNorth.getY()];
			if(goNorth != null && goNorth.getC()!='*' && !northGrid.isVisited()) {
				//	northGrid.setVisited(true);
				endingX=end.getX()-goNorth.getX();
				endingY=end.getY()-goNorth.getY();
				if(goNorth.getC()=='M') 
				{
					if(currentGrid.speed<0.1) continue;
						goNorth.speed =currentGrid.speed -((float)0.1*10/10);
					//goNorth.setSpeed(this.speed );
				}
				else
				{
					goNorth.speed=currentGrid.speed;
				}
				northGrid.manDistance = Math.abs((endingX) + (endingY))/currentGrid.getSpeed();



				

				//System.out.println("north: " +northGrid.manDistance);
				//	Grid northNewGrid = createNewGrid(northGrid,northGrid.goNorth());
				//Grid northNewGrid = createNewGrid(currentGrid,northGrid);
				//writer.write("x ="+goNorth.getX()+ "y=" +goNorth.getY() +LINE_BREAK);
				float totalLen = currentGrid.getTotalLen() + 1/(currentGrid.speed);
				northGrid.setTotalLen(totalLen);
				northGrid.setTotalHeuristic(totalLen + northGrid.getManDist());
				astar.append("index = "+counterChild+" x = "+goNorth.getX()+" y = "+goNorth.getY()+" speed = "+goNorth.getSpeed()+" g = " +totalLen+ " f = " +goNorth.getTotalHeuristic()+ LINE_BREAK);		
				//	System.out.println("testN: " +northNewGrid.getTotalHeuristic());
				northGrid.setParentNode(currentGrid);
				if (!open.contains(northGrid))
				//open.add(northGrid);
					if(open.size() < currentGrid.getBeamValue())
					{
						open.add(northGrid);
						northGrid.setVisited(true);
					}
					else if(open.size()==currentGrid.getBeamValue())
					{
							/*Iterator<Grid> it1;

							it1=open.iterator();
							Grid min=it1.next();
							
							while(it1.hasNext())
							{
								Grid tmp=it1.next();
								if (tmp.getTotalHeuristic()> min.getTotalHeuristic())
									min=tmp;
								//it1.next();
							}*/
							Iterator<Grid> it1;
							it1=open.iterator();
							Grid max=it1.next();
							Grid temp=null;
							while(it1.hasNext()){
								temp=it1.next();
								if(temp.getBeamValue()>max.getBeamValue()){
									max=temp;
								}
							}
							if(max.getBeamValue()<northGrid.getBeamValue()){
							open.remove(max);
							open.add(northGrid);
							northGrid.setVisited(true);
							}

						}
					if(northGrid.getC() == goalNode.getC()) {currentGrid=goalNode; break;}
				

			}
			Grid eastGrid = this.grid[goEast.getX()][goEast.getY()];
			if(goEast != null && goEast.getC()!='*' && !eastGrid.isVisited()) {
				//	eastGrid.setVisited(true);
				endingX=end.getX()-goEast.getX();
				endingY=end.getY()-goEast.getY();
				if(goEast.getC()=='M') 
				{
					if(currentGrid.speed<0.1) continue;
						goEast.speed =currentGrid.speed -((float)0.1*10/10);
					//goNorth.setSpeed(this.speed );
				}
				else
				{
				goEast.speed=currentGrid.speed;
				}

				eastGrid.manDistance = Math.abs((endingX) + (endingY))/currentGrid.getSpeed();
				//System.out.println("east: " +eastGrid.manDistance);

				//Grid eastNewGrid = createNewGrid(currentGrid,eastGrid);

				

				//astar.append("x ="+goEast.getX()+ "y=" +goEast.getY() +LINE_BREAK);
				float totalLen = currentGrid.getTotalLen() + 1/(currentGrid.speed);
				eastGrid.setTotalLen(totalLen);
				eastGrid.setTotalHeuristic(totalLen + eastGrid.getManDist());
				astar.append("index = "+counterChild+" x = "+goEast.getX()+" y = "+goEast.getY()+" speed = "+goEast.getSpeed()+" g = " +totalLen+ " f = " +goEast.getTotalHeuristic() +LINE_BREAK);
				//		System.out.println("testE: " +eastNewGrid.getTotalHeuristic());
				eastGrid.setParentNode(currentGrid);
				if (!open.contains(eastGrid))
				//open.add(eastGrid);
					
							if(open.size() < currentGrid.getBeamValue())
							{
								open.add(eastGrid);
								eastGrid.setVisited(true);
							}
							else if(open.size()>=currentGrid.getBeamValue())
							{
								/*Iterator<Grid> it1;
								it1=open.iterator();
								Grid min=it1.next();
								
								while(it1.hasNext())
								{
									Grid tmp=it1.next();
									if (tmp.getTotalHeuristic()> min.getTotalHeuristic())
										min=tmp;
									//it1.next();
								}*/
								Iterator<Grid> it1;
								it1=open.iterator();
								Grid max=it1.next();
								Grid temp=null;
								while(it1.hasNext()){
									temp=it1.next();
									if(temp.getBeamValue()>max.getBeamValue()){
										max=temp;
									}
								}
								if(max.getBeamValue()<eastGrid.getBeamValue()){
								open.remove(max);
								open.add(eastGrid);
								eastGrid.setVisited(true);
								}

							}

				if(eastGrid.getC() == goalNode.getC()) {currentGrid=goalNode; break;}

			}
			Grid southGrid = this.grid[goSouth.getX()][goSouth.getY()];
			if(goSouth != null && goSouth.getC()!='*' && !southGrid.isVisited()) {
				//	southGrid.setVisited(true);
				endingX=end.getX()-goSouth.getX();
				endingY=end.getY()-goSouth.getY();
				if(goSouth.getC()=='M') 
				{
					if(currentGrid.speed<0.1) continue;
						goSouth.speed =currentGrid.speed -((float)0.1*10/10);
					//goNorth.setSpeed(this.speed );
				}
				else
				{
					goSouth.speed=currentGrid.speed;
				}
				southGrid.manDistance = Math.abs((endingX) + (endingY))/currentGrid.getSpeed();

				
				//System.out.println("south: " +southGrid.manDistance);
				//Grid southNewGrid = createNewGrid(currentGrid,southGrid);


				astar.append("x ="+goSouth.getX()+ "y=" +goSouth.getY() +LINE_BREAK);
				float totalLen = currentGrid.getTotalLen() + 1/(currentGrid.speed);
				southGrid.setTotalLen(totalLen);
				southGrid.setTotalHeuristic(totalLen + southGrid.getManDist());
				//		System.out.println("testS: " +southNewGrid.getTotalHeuristic());
				astar.append("index = "+counterChild+" x = "+goSouth.getX()+" y = "+goSouth.getY()+" speed = "+goSouth.getSpeed()+" g = " +totalLen+ " f = " +goSouth.getTotalHeuristic()+LINE_BREAK);
				southGrid.setParentNode(currentGrid);
				if (!open.contains(southGrid))
					if(open.size() < currentGrid.getBeamValue())
					{
						open.add(southGrid);
						southGrid.setVisited(true);
					}
					else if(open.size()==currentGrid.getBeamValue())
						{
							/*Iterator<Grid> it1;
							it1=open.iterator();
							Grid min=it1.next();
							
							while(it1.hasNext())
							{
								Grid tmp=it1.next();
								if (tmp.getTotalHeuristic()> min.getTotalHeuristic())
									min=tmp;
								//it1.next();
							}*/
							Iterator<Grid> it1;
							it1=open.iterator();
							Grid max=it1.next();
							Grid temp=null;
							while(it1.hasNext()){
								temp=it1.next();
								if(temp.getBeamValue()>max.getBeamValue()){
									max=temp;
								}
							}
							if(max.getBeamValue()<southGrid.getBeamValue()){
							open.remove(max);
							open.add(southGrid);
							southGrid.setVisited(true);
							}

						}

				if(southGrid.getC() == goalNode.getC()) {currentGrid=goalNode; break;}


			}

			Grid westGrid = this.grid[goWest.getX()][goWest.getY()];
			if(goWest != null && goWest.getC()!='*' && !westGrid.isVisited()) {
				//	westGrid.setVisited(true);
				endingX=end.getX()-goWest.getX();
				endingY=end.getY()-goWest.getY();
				if(goWest.getC()=='M') 
				{
					if(currentGrid.speed<0.1) continue;
						goWest.speed =currentGrid.speed -((float)0.1*10/10);
					//goNorth.setSpeed(this.speed );
				}
				else
				{
					goWest.speed=currentGrid.speed;
				}
				westGrid.manDistance = Math.abs((endingX) + (endingY))/currentGrid.getSpeed();

				
				//System.out.println("west: " +westGrid.manDistance);
				//Grid westNewGrid = createNewGrid(currentGrid,westGrid);

				astar.append("x ="+goWest.getX()+ "y=" +goWest.getY() +LINE_BREAK);
				float totalLen = currentGrid.getTotalLen() + 1/(currentGrid.speed);
				westGrid.setTotalLen(totalLen);
				westGrid.setTotalHeuristic(totalLen + westGrid.getManDist());
				astar.append("index = "+counterChild+" x = "+goWest.getX()+" y = "+goWest.getY()+" speed = "+goWest.getSpeed()+" g = " +totalLen+ " f = " +goWest.getTotalHeuristic()+LINE_BREAK);
				//		System.out.println("testW: " +westNewGrid.getTotalHeuristic());
				westGrid.setParentNode(currentGrid);
				if (!open.contains(westGrid))
					if(open.size() < currentGrid.getBeamValue())
					{
						open.add(westGrid);
						westGrid.setVisited(true);
					}
					else if(open.size()==currentGrid.getBeamValue())
					/*{
						Iterator<Grid> it1;
						it1=open.iterator();
						Grid min=it1.next();
						while(it1.hasNext())
						{
							Grid tmp=it1.next();
							if (tmp.getTotalHeuristic()< min.getTotalHeuristic())
								min=tmp;
						}
						open.remove(min);
						open.add(westGrid);


					}
*/
					//open.add(westGrid);
						//else if(open.size()>=currentGrid.getBeamValue())
						{
							/*Iterator<Grid> it1;
							it1=open.iterator();
							Grid min=it1.next();
							
							while(it1.hasNext())
							{
								Grid tmp=it1.next();
								if (tmp.getTotalHeuristic()> min.getTotalHeuristic())
									min=tmp;
								//it1.next();
							}*/
							Iterator<Grid> it1;
							it1=open.iterator();
							Grid max=it1.next();
							Grid temp=null;
							while(it1.hasNext()){
								temp=it1.next();
								if(temp.getBeamValue()>max.getBeamValue()){
									max=temp;
								}
							}
							if(max.getBeamValue()<westGrid.getBeamValue()){
							open.remove(max);
							open.add(westGrid);
							westGrid.setVisited(true);
							}

						}
				if(westGrid.getC() == goalNode.getC()) {currentGrid=goalNode; break;}




			}

			astar.append("Frontier List : " +LINE_BREAK);
			Iterator<Grid> it;
			it=open.iterator();

			while(it.hasNext())
			{
				Grid tmp=(Grid) it.next();
				astar.append("x= "  +tmp.getX() );
				astar.append(" y= " +tmp.getY());
				astar.append(" speed = " +tmp.getSpeed());
				astar.append(" g = " +tmp.getTotalLen()) ;
				astar.append(" f = " +tmp.getTotalHeuristic() +LINE_BREAK);
				if(tmp.getC()== goalNode.getC()) { currentGrid= goalNode; break;}
				//inverse =+ tmp.getTotalLen();
			}
			//inverse+= 1/(currentGrid.getSpeed());
			//grid[current_x][current_y].setVisited(true);


			
		}
		
		//Grid currentGrid=goalNode;
		//System.out.println("Currentgrid"+currentGrid.getC());
		Grid temp=currentGrid;
		LinkedList<Grid> rev=new LinkedList<Grid>();
		int count90=0;
		while(!temp.equals(startNode))
		{
			count90++;
			//System.out.println();
			rev.add(temp);
			temp=temp.getParentNode();
		}
		rev.add(startNode);
		count90--;
		writer.write("Number of iterations =" +count +LINE_BREAK);
		writer.write("Path Length = " +count90 +LINE_BREAK);
		Collections.reverse(rev);
		float  gvalue2 = 0;
		for(int j=0;j<rev.size();j++){
		
			writer.write("x = "+rev.get(j).getX()+" y = "+rev.get(j).getY()+" speed = "+rev.get(j).getSpeed()+" g = "+gvalue2+ " f = " +rev.get(j).getTotalHeuristic() +LINE_BREAK);
			gvalue2 += (float) (1/(rev.get(j).speed));
		}
		//return null;	 	
		
		writer.write(astar.toString());
		writer.close();
		System.out.println("Please check the output file");
			 	
}	 

		//*************************************************************************************************************************************

		private void AstarSearch() throws IOException {
			PriorityQueue<Grid> open =new PriorityQueue<Grid>(1000, new HeuristicComparator());
			//	Queue<Grid> closed =new LinkedList<Grid>();

			open.add(this.startNode);
			startNode.setVisited(true);
			startNode.setSpeed(speed);
			startNode.setTotalLen(0f);
			startNode.manDistance = Math.abs((goalNode.getX()-startNode.getX()) + (goalNode.getY()-startNode.getY()))/startNode.getSpeed();
			startNode.setTotalHeuristic(startNode.getTotalLen()+startNode.getManDist());
			Grid end = this.goalNode;
			//startNode= open.poll();
			//System.out.println("x" + end.getX() + "y"  +end.getY());
			int count=1;
			//	int ManDist=0;
			int endingX=0;
			int endingY=0;
			StringBuffer astar= new StringBuffer();
			File outputFile =  new File(this.outputFile);
			BufferedWriter writer = new BufferedWriter(new FileWriter(outputFile));
			//	int T_ManDist=0;
			Grid currentGrid=null;


			while(!open.isEmpty()) 
			{
				//if(count<=100)
					astar.append("Iteration = "+count +LINE_BREAK);
				currentGrid = open.remove();
				currentGrid.speed= speed;
				int counterChild=0; //inverse= 1/(currentGrid.getSpeed());
				//System.out.println("Number of iterations"  +count);
				//if(count<=100)
					astar.append("Current Node : x = "+currentGrid.getX()+" y = "+currentGrid.getY()+" speed = "+currentGrid.getSpeed()+" g =" +currentGrid.getTotalLen()+ " f = "  +currentGrid.getTotalHeuristic() +LINE_BREAK);

				count++;


				if(currentGrid.getC() ==(goalNode.getC())){
					//System.out.println(currentGrid);

					//System.out.println("Path Length" + open.size());
					astar.append("Goal node found");
					//writer.close();
					//return currentGrid;
				}

				Grid goNorth=currentGrid.goNorth();
				Grid goEast=currentGrid.goEast();
				Grid goSouth=currentGrid.goSouth();
				Grid goWest=currentGrid.goWest();

				//if(count<=100) 
				astar.append("Child List:");
				Grid northGrid = this.grid[goNorth.getX()][goNorth.getY()];
				if(goNorth != null && goNorth.getC()!='*' && !northGrid.isVisited()) {
					//	northGrid.setVisited(true);
					endingX=end.getX()-goNorth.getX();
					endingY=end.getY()-goNorth.getY();
					if(goNorth.getC()=='M') 
					{
						if(currentGrid.speed<0.1) continue;
							goNorth.speed =currentGrid.speed -((float)0.1*10/10);
						//goNorth.setSpeed(this.speed );
					}
					else
					{
						goNorth.speed=currentGrid.speed;
					}
					northGrid.manDistance = Math.abs((endingX) + (endingY))/currentGrid.getSpeed();



					northGrid.setVisited(true);

					//System.out.println("north: " +northGrid.manDistance);
					//	Grid northNewGrid = createNewGrid(northGrid,northGrid.goNorth());
					//Grid northNewGrid = createNewGrid(currentGrid,northGrid);
					//writer.write("x ="+goNorth.getX()+ "y=" +goNorth.getY() +LINE_BREAK);
					float totalLen = currentGrid.getTotalLen() + 1/(currentGrid.speed);
					northGrid.setTotalLen(totalLen);
					northGrid.setTotalHeuristic(totalLen + northGrid.getManDist());
					astar.append("index = "+counterChild+" x = "+goNorth.getX()+" y = "+goNorth.getY()+" speed = "+goNorth.getSpeed()+" g = " +totalLen+ " f = " +goNorth.getTotalHeuristic()+ LINE_BREAK);		
					//	System.out.println("testN: " +northNewGrid.getTotalHeuristic());
					northGrid.setParentNode(currentGrid);
					if (!open.contains(northGrid))
					open.add(northGrid);
					if(northGrid.getC() == goalNode.getC()) {currentGrid=goalNode; break;}
					

				}
				Grid eastGrid = this.grid[goEast.getX()][goEast.getY()];
				if(goEast != null && goEast.getC()!='*' && !eastGrid.isVisited()) {
					//	eastGrid.setVisited(true);
					endingX=end.getX()-goEast.getX();
					endingY=end.getY()-goEast.getY();
					if(goEast.getC()=='M') 
					{
						if(currentGrid.speed<0.1) continue;
							goEast.speed =currentGrid.speed -((float)0.1*10/10);
						//goNorth.setSpeed(this.speed );
					}
					else
					{
						goEast.speed=currentGrid.speed;
					}

					eastGrid.manDistance = Math.abs((endingX) + (endingY))/currentGrid.getSpeed();
					//System.out.println("east: " +eastGrid.manDistance);

					//Grid eastNewGrid = createNewGrid(currentGrid,eastGrid);

					eastGrid.setVisited(true);

					//astar.append("x ="+goEast.getX()+ "y=" +goEast.getY() +LINE_BREAK);
					float totalLen = currentGrid.getTotalLen() + 1/(currentGrid.speed);
					eastGrid.setTotalLen(totalLen);
					eastGrid.setTotalHeuristic(totalLen + eastGrid.getManDist());
					astar.append("index = "+counterChild+" x = "+goEast.getX()+" y = "+goEast.getY()+" speed = "+goEast.getSpeed()+" g = " +totalLen+ " f = " +goEast.getTotalHeuristic() +LINE_BREAK);
					//		System.out.println("testE: " +eastNewGrid.getTotalHeuristic());
					eastGrid.setParentNode(currentGrid);
					if (!open.contains(eastGrid))
					open.add(eastGrid);
					if(eastGrid.getC() == goalNode.getC()) {currentGrid=goalNode; break;}

				}
				Grid southGrid = this.grid[goSouth.getX()][goSouth.getY()];
				if(goSouth != null && goSouth.getC()!='*' && !southGrid.isVisited()) {
					//	southGrid.setVisited(true);
					endingX=end.getX()-goSouth.getX();
					endingY=end.getY()-goSouth.getY();
					if(goSouth.getC()=='M') 
					{
						if(currentGrid.speed<0.1) continue;
							goSouth.speed =currentGrid.speed -((float)0.1*10/10);
						//goNorth.setSpeed(this.speed );
					}
					else
					{
						goSouth.speed=currentGrid.speed;
					}
					southGrid.manDistance = Math.abs((endingX) + (endingY))/currentGrid.getSpeed();

					southGrid.setVisited(true);
					//System.out.println("south: " +southGrid.manDistance);
					//Grid southNewGrid = createNewGrid(currentGrid,southGrid);


					astar.append("x ="+goSouth.getX()+ "y=" +goSouth.getY() +LINE_BREAK);
					float totalLen = currentGrid.getTotalLen() + 1/(currentGrid.speed);
					southGrid.setTotalLen(totalLen);
					southGrid.setTotalHeuristic(totalLen + southGrid.getManDist());
					//		System.out.println("testS: " +southNewGrid.getTotalHeuristic());
					astar.append("index = "+counterChild+" x = "+goSouth.getX()+" y = "+goSouth.getY()+" speed = "+goSouth.getSpeed()+" g = " +totalLen+ " f = " +goSouth.getTotalHeuristic()+LINE_BREAK);
					southGrid.setParentNode(currentGrid);
					if (!open.contains(southGrid))
					open.add(southGrid);
					if(southGrid.getC() == goalNode.getC()) {currentGrid=goalNode; break;}


				}

				Grid westGrid = this.grid[goWest.getX()][goWest.getY()];
				if(goWest != null && goWest.getC()!='*' && !westGrid.isVisited()) {
					//	westGrid.setVisited(true);
					endingX=end.getX()-goWest.getX();
					endingY=end.getY()-goWest.getY();
					if(goWest.getC()=='M') 
					{
						if(currentGrid.speed<0.1) continue;
							goWest.speed =currentGrid.speed -((float)0.1*10/10);
						//goNorth.setSpeed(this.speed );
					}
					else
					{
						goWest.speed=currentGrid.speed;
					}
					westGrid.manDistance = Math.abs((endingX) + (endingY))/currentGrid.getSpeed();

					westGrid.setVisited(true);
					//System.out.println("west: " +westGrid.manDistance);
					//Grid westNewGrid = createNewGrid(currentGrid,westGrid);

					astar.append("x ="+goWest.getX()+ "y=" +goWest.getY() +LINE_BREAK);
					float totalLen = currentGrid.getTotalLen() + 1/(currentGrid.speed);
					westGrid.setTotalLen(totalLen);
					westGrid.setTotalHeuristic(totalLen + westGrid.getManDist());
					astar.append("index = "+counterChild+" x = "+goWest.getX()+" y = "+goWest.getY()+" speed = "+goWest.getSpeed()+" g = " +totalLen+ " f = " +goWest.getTotalHeuristic()+LINE_BREAK);
					//		System.out.println("testW: " +westNewGrid.getTotalHeuristic());
					westGrid.setParentNode(currentGrid);
					if (!open.contains(westGrid))
					open.add(westGrid);
					if(westGrid.getC() == goalNode.getC()) {currentGrid=goalNode; break;}




				}

				astar.append("Frontier List : " +LINE_BREAK);
				Iterator<Grid> it;
				it=open.iterator();

				while(it.hasNext())
				{
					Grid tmp=(Grid) it.next();
					astar.append("x= "  +tmp.getX() );
					astar.append(" y= " +tmp.getY());
					astar.append(" speed = " +tmp.getSpeed());
					astar.append(" g = " +tmp.getTotalLen()) ;
					astar.append(" f = " +tmp.getTotalHeuristic() +LINE_BREAK);
					if(tmp.getC()== goalNode.getC()) { currentGrid= goalNode; break;}
					//inverse =+ tmp.getTotalLen();
				}
				//inverse+= 1/(currentGrid.getSpeed());
				//grid[current_x][current_y].setVisited(true);


				
			}
			
			//Grid currentGrid=goalNode;
			//System.out.println("Currentgrid"+currentGrid.getC());
			Grid temp=currentGrid;
			LinkedList<Grid> rev=new LinkedList<Grid>();
			int count90=0;
			while(!temp.equals(startNode))
			{
				count90++;
				//System.out.println();
				rev.add(temp);
				temp=temp.getParentNode();
			}
			rev.add(startNode);
			count90--;
			writer.write("Number of iterations =" +count +LINE_BREAK);
			writer.write("Path Length = " +count90 +LINE_BREAK);
			Collections.reverse(rev);
			float  gvalue2 = 0;
			for(int j=0;j<rev.size();j++){
				
				writer.write("x = "+rev.get(j).getX()+" y = "+rev.get(j).getY()+" speed = "+rev.get(j).getSpeed()+" g = "+gvalue2+ " f = " +rev.get(j).getTotalHeuristic() +LINE_BREAK);
				gvalue2 += (float) (1/(rev.get(j).speed));
			}
			//return null;	 	
			astar.append("--------------------------------------------------------------------------" +LINE_BREAK);
			astar.append("Search Log" +LINE_BREAK);	
			writer.write(astar.toString());
			writer.close();
			System.out.println("Please check the output file");
		}

		//*****************************************************************************************************************	
		private void DFSSearch() throws IOException 
		{
			Stack<Grid> stack = new Stack<Grid>();
			stack.push(this.startNode);
			startNode.setGvalue(0f);
			StringBuffer dfs = new StringBuffer();
			startNode.setVisited(true);
			startNode.setSpeed(speed);
			Grid currentGrid=null; //= stack.peek();
			//	System.out.println("x:" + x2 +"," +"y" + y2 + "," + currentGrid.c);
			//	this.grid[x2][y2].setVisited(true);
			int count = 1;
			boolean hasNorth;
			boolean hasSouth;
			boolean hasEast;
			boolean hasWest;
			File outputFile =  new File(this.outputFile);
			BufferedWriter writer = new BufferedWriter(new FileWriter(outputFile));
			//float gvalueStack= 0;
			//float gvalueChild = 0;
			do{
				if(!stack.isEmpty())
				{
					int counterChild=0; 
					currentGrid = stack.pop(); 
					if(count<=100)
						dfs.append("Iterations " +count +LINE_BREAK);
					//System.out.println("Iteration = "+count + LINE_BREAK);
					if(count<=100)
						dfs.append("Current Node : x = "+currentGrid.getX()+" y = "+currentGrid.getY()+" speed = "+currentGrid.getSpeed()+" g =" +currentGrid.getGvalue() +LINE_BREAK);
					//writer.write(String.valueOf(count++) + LINE_BREAK);
					//gvalue = gvalue +(1/this.speed);

					//*****************************************************************************	


					if(count<=100)
						dfs.append("Child List:" +LINE_BREAK);

					Grid goNorth = currentGrid.goNorth();
					if(goNorth!=null && goNorth.getC()!='*' ){
						//gvalue += (float) 1/goNorth.getSpeed() ;

						if(goNorth.c=='M' && !this.grid[goNorth.getX()][goNorth.getY()].isVisited()){
							goNorth.speed =(currentGrid.speed -(float)0.1)*10/10;
							//goNorth.speed=this.speed;
							//gvalue = gvalue +(1/this.speed);

						}
						else
						{
							goNorth.speed=currentGrid.speed;

						}
						goNorth.setGvalue(currentGrid.getGvalue()+ (1/currentGrid.getSpeed()));
						if(count<=100)
							dfs.append("index = "+counterChild+" x = "+goNorth.getX()+" y = "+goNorth.getY()+" speed = "+goNorth.getSpeed()+" g = " + goNorth.getGvalue() +LINE_BREAK);

					}
					Grid goEast = currentGrid.goEast();
					if(goEast!=null && goEast.getC()!='*'){
						//gvalue += (float) 1/goEast.getSpeed() ;
						if(goEast.c=='M' && !this.grid[goEast.getX()][goEast.getY()].isVisited()){
							goEast.speed =(currentGrid.speed -(float)0.1)*10/10;

							//goEast.setSpeed(this.speed );
							//gvalue = gvalue +(1/this.speed); 
						}
						else
						{
							goEast.speed=currentGrid.speed;
						}
						goEast.setGvalue(currentGrid.getGvalue()+ (1/currentGrid.getSpeed()));
						if(count<=100)
							dfs.append("index = "+counterChild+" x = "+goEast.getX()+" y = "+goEast.getY()+" speed = "+goEast.getSpeed()+ " g = " + goEast.getGvalue() +LINE_BREAK);
					}

					Grid goSouth = currentGrid.goSouth();
					if(goSouth!=null && goSouth.getC()!='*'){
						if(goSouth.c=='M' && !this.grid[goSouth.getX()][goSouth.getY()].isVisited()) 
						{
							//gvalue += (float) 1/goSouth.getSpeed() ;

							goSouth.speed =(currentGrid.speed -(float)0.1)*10/10;
							//goSouth.setSpeed(this.speed);
							//gvalue = gvalue +(1/this.speed); 
						}
						else
						{
							goSouth.speed=currentGrid.speed;
						}
						goSouth.setGvalue(currentGrid.getGvalue()+ (1/currentGrid.getSpeed()));	
						if(count<=100)
							dfs.append("index = "+counterChild+" x = "+goSouth.getX()+" y = "+goSouth.getY()+" speed = "+goSouth.getSpeed()+" g = "  +goSouth.getGvalue()+LINE_BREAK);
					}
					Grid goWest = currentGrid.goWest();
					if(goWest!=null && goWest.getC()!='*' ){
						//gvalue += (float) 1/goWest.getSpeed() ;
						if(goWest.c=='M' && !this.grid[goWest.getX()][goWest.getY()].isVisited()){
							goWest.speed =(currentGrid.speed -(float)0.1)*10/10;
							//goWest.setSpeed(this.speed );
							//gvalue = gvalue +(1/this.speed); 
						}
						else
						{
							goWest.speed=currentGrid.speed;
						}
						goWest.setGvalue(currentGrid.getGvalue()+ (1/currentGrid.getSpeed()));	
						if(count<=100)
							dfs.append("index = "+counterChild+" x = "+goWest.getX()+" y = "+goWest.getY()+" speed = "+goWest.getSpeed()+" g = " +goWest.getGvalue() +LINE_BREAK);
					}
					//*********************************************************************************************		

					count++;
					hasNorth = false;
					hasSouth = false;
					hasEast = false;
					hasWest = false;


					if(goNorth != null && goNorth.getC()!='*' && !goNorth.isVisited()){
						goNorth.setVisited(true);


						stack.push( goNorth);

						hasNorth = true;
						//System.out.println("index = "+counterChild+" x = "+goNorth.getX()+" y = "+goNorth.getY()+" speed = 2 g = 0");

						goNorth.setParentNode(currentGrid);
						/*if(goNorth.getC()=='G') { currentGrid=goalNode; 
						break; }*/
					}


					if(goEast != null && goEast.getC()!='*' && !goEast.isVisited()){
						goEast.setVisited(true);

						stack.push(goEast);

						hasEast = true;
						//System.out.println("index = "+counterChild+" x = "+goEast.getX()+" y = "+goEast.getY()+" speed = 2 g = 0");

						goEast.setParentNode(currentGrid);
						/*if(goEast.getC()=='G') { currentGrid=goalNode;
						break; }*/
					}


					if(goSouth != null && goSouth.getC()!='*' && !goSouth.isVisited()){
						goSouth.setVisited(true);

						stack.push(goSouth);

						hasSouth = true;
						//System.out.println("index = "+counterChild+" x = "+goSouth.getX()+" y = "+goSouth.getY()+" speed = 2 g = 0");

						goSouth.setParentNode(currentGrid);
						/*if(goSouth.getC()=='G') { currentGrid=goalNode;
						break;}*/
					}


					if(goWest != null && goWest.getC()!='*' && !goWest.isVisited()){
						goWest.setVisited(true);

						stack.add(goWest);

						hasWest = true;
						//System.out.println("index = "+counterChild+" x = "+goWest.getX()+" y = "+goWest.getY()+" speed = 2 g = 0");

						goWest.setParentNode(currentGrid);
						/*if(goWest.getC()=='G'){

					currentGrid=goalNode;

						break; }*/
					}
					//************************************************************************************************
					if(count<=100)
						dfs.append("Frontier List:" +LINE_BREAK);
					//x2 = currentGrid.getX();
					//y2 = currentGrid.getY();
					//System.out.println("x:" + x2 +"," +"y" + y2 + ",c: " + currentGrid.getC());
					//this.grid[x2][y2].setVisited(true);

					for(int i=0;i<stack.size();i++){
						if(count<=100)
							dfs.append("index = "+i+" x = "+stack.get(i).getX()+" y = "+stack.get(i).getY()+" speed = "+stack.get(i).getSpeed()+ " g = " +stack.get(i).getGvalue()+LINE_BREAK);
						//gvalueStack += 1/(this.speed); 
					}
					//if(!(hasNorth || hasSouth || hasEast ||hasWest)){
					//if(!stack.isEmpty()){
					//stack.pop();
					//}
				}
				/*if(this.speed<=0)
				{System.out.println("speed decreased under zero");
				break;
				}
				 */

				//System.out.println(this.speed);
			}while(currentGrid.getC() != this.goalNode.getC());

			//writer.write("count:" + count+ LINE_BREAK);
			//writer.write("x:" + currentGrid.getX() +"," +"y:" + currentGrid.getY() + ",c: " + currentGrid.getC() +LINE_BREAK);
			//writer.write("speed=" +this.speed + "," +"g=" +(1/this.speed) +LINE_BREAK);
			

			Grid temp=currentGrid;
			LinkedList<Grid> rev=new LinkedList<Grid>();
			while(!temp.equals(startNode))
			{
				rev.add(temp);
				temp=temp.getParentNode();
			}
			rev.add(startNode);
			writer.write("Number of iterations =" +count +LINE_BREAK);
			writer.write("Path Length = " +rev.size() +LINE_BREAK);
			Collections.reverse(rev);
			//float gvalue1=0;
			for(int j=0;j<rev.size();j++){
				if(rev.get(j).getSpeed()<=0) { dfs.append("Path not found" +LINE_BREAK);
					break; }
				writer.write("x = "+rev.get(j).getX()+" y = "+rev.get(j).getY()+" speed = "+rev.get(j).getSpeed()+" g= " +rev.get(j).getGvalue() +LINE_BREAK);
				//gvalue1 +=(float) 1/(rev.get(j).getSpeed()); 
			}
			dfs.append("----------------------------------------------------------" +LINE_BREAK);
			dfs.append("Search Log" +LINE_BREAK);
			writer.write(dfs.toString() +LINE_BREAK);
			System.out.println("Please check output file");
			writer.close();
		}
		//*******************************************************************************************************************************************************
		public  void BFSSearch() throws IOException {
			LinkedList<Grid> queue = new LinkedList<Grid>();
			queue.addLast(this.startNode);
			Grid currentGrid = queue.remove();
			int x2 = currentGrid.getX();
			int y2 = currentGrid.getY();
			currentGrid.speed=speed;
			StringBuffer bfs = new StringBuffer();
			//	System.out.println("x:" + x2 +"," +"y" + y2 + "," + currentGrid.c);
			this.grid[x2][y2].setVisited(true);
			int count=1;
			File outputFile =  new File(this.outputFile);
			BufferedWriter writer = new BufferedWriter(new FileWriter(outputFile));
			do
			{
				int counterChild=0;
				if(count<=100)
					bfs.append("Iteration = "+count +LINE_BREAK);

				if(count<=100)
					bfs.append("Current Node : x = "+currentGrid.getX()+" y = "+currentGrid.getY()+" speed = "+currentGrid.getSpeed()+"  g = " +currentGrid.getGvalue() +LINE_BREAK);
				
				//**************************************************************************//
				if(count<=100)
					bfs.append("Child List:" +LINE_BREAK);

				Grid goNorth = currentGrid.goNorth();
				if(goNorth != null && goNorth.getC()!='*')
				{
					if(goNorth.c=='M' && !this.grid[goNorth.getX()][goNorth.getY()].isVisited()){
						goNorth.speed =(currentGrid.speed -(float)0.1)*10/10;
						//goNorth.speed=this.speed;
					}
					else
					{
						goNorth.speed=currentGrid.speed;

					}
					goNorth.setGvalue(currentGrid.getGvalue()+ (1/currentGrid.getSpeed()));

					if(count<=100)
						bfs.append("index = "+counterChild+" x = "+goNorth.getX()+" y = "+goNorth.getY()+" speed = "   +goNorth.getSpeed()+" g = "  +(goNorth.getGvalue()) +LINE_BREAK);
				}
				Grid goEast = currentGrid.goEast();
				if(goEast != null && goEast.getC()!='*') {
					if(goEast.c=='M' && !this.grid[goEast.getX()][goEast.getY()].isVisited()){
						goEast.speed =(currentGrid.speed -(float)0.1)*10/10;
						//goEast.setSpeed(this.speed );
						//gvalue += (float)(1/(goEast.getSpeed()));
					}
					else
					{
						goEast.speed=currentGrid.speed;
					}

					goEast.setGvalue(currentGrid.getGvalue()+ (1/currentGrid.getSpeed()));

					if(count<=100)
						bfs.append("index = "+counterChild+" x = "+goEast.getX()+" y = "+goEast.getY()+" speed = "   +goEast.getSpeed()+" g = " + goEast.getGvalue() +LINE_BREAK); 
				}
				Grid goSouth = currentGrid.goSouth();
				if(goSouth != null && goSouth.getC()!='*')
				{

					if(goSouth.c=='M'  && !this.grid[goSouth.getX()][goSouth.getY()].isVisited() ){
						goSouth.speed =(currentGrid.speed -(float)0.1)*10/10;
						//goSouth.speed=this.speed;
						//	gvalue += (float)(1/(goSouth.getSpeed()));
					}
					else
					{
						goSouth.speed=currentGrid.speed;
					}
					goSouth.setGvalue(currentGrid.getGvalue()+ (1/currentGrid.getSpeed()));
					if(count<=100)
						bfs.append("index = "+counterChild+" x = "+goSouth.getX()+" y = "+goSouth.getY()+" speed = " +goSouth.getSpeed()+" g = " +goSouth.getGvalue() +LINE_BREAK);
				}
				Grid goWest = currentGrid.goWest();
				if(goWest != null && goWest.getC()!='*')
				{
					if(goWest.c=='M' && !this.grid[goWest.getX()][goWest.getY()].isVisited()){
						goWest.speed =(currentGrid.speed -(float)0.1)*10/10;
						//goWest.speed=this.speed ;
						//gvalue += (float)(1/(goWest.getSpeed()));
					}
					else
					{
						goWest.speed=currentGrid.speed;
					}
					goWest.setGvalue(currentGrid.getGvalue()+ (1/currentGrid.getSpeed()));
					if(count<=100)
						bfs.append("index = "+counterChild+" x = "+goWest.getX()+" y = "+goWest.getY()+" speed = "   +goWest.speed+" g = " + goWest.getGvalue() + LINE_BREAK);
				}


				//**************************************************************************//
				//System.out.println(speed);
				if(goNorth != null && goNorth.getC()!='*' && !this.grid[goNorth.getX()][goNorth.getY()].isVisited()){
					this.grid[goNorth.getX()][goNorth.getY()].setVisited(true);
					queue.addLast(goNorth);
					goNorth.setParentNode(currentGrid);
					//System.out.println(goNorth.getC());

					//System.out.println("gonorth" +goNorth.speed);
				}if(goEast != null && goEast.getC()!='*' && !this.grid[goEast.getX()][goEast.getY()].isVisited()){
					this.grid[goEast.getX()][goEast.getY()].setVisited(true);
					queue.addLast(goEast);
					goEast.setParentNode(currentGrid);
					//System.out.println(goEast.getC());

					//System.out.println("goeast" +goEast.speed);
				}if(goSouth != null && goSouth.getC()!='*' && !this.grid[goSouth.getX()][goSouth.getY()].isVisited()){
					this.grid[goSouth.getX()][goSouth.getY()].setVisited(true);
					queue.addLast(goSouth);
					goSouth.setParentNode(currentGrid);
					//System.out.println(goSouth.getC());

					goSouth.setParentNode(currentGrid);



					//System.out.println("gosouth" +goSouth.speed);
				}if(goWest != null && goWest.getC()!='*' && !this.grid[goWest.getX()][goWest.getY()].isVisited()){
					this.grid[goWest.getX()][goWest.getY()].setVisited(true);
					queue.addLast(goWest);
					goWest.setParentNode(currentGrid);
					//System.out.println(goWest.getC());

					goWest.setParentNode(currentGrid);

					//System.out.println("gowest" +goWest.speed);
				}
				//****************************************************************************************//
				if(count<=100)
					bfs.append("Frontier List:");

				//x2 = currentGrid.getX();
				//y2 = currentGrid.getY();
				//writer.write("x:" + x2 +"," +"y" + y2 + ",c: " + currentGrid.getC() + LINE_BREAK);
				//writer.write("speed=" +this.speed + "," +"g=" +(1/this.speed) + LINE_BREAK);
				//this.grid[x2][y2].setVisited(true);

				for(int i=0;i<queue.size();i++){
					if(count<=100)
						bfs.append("index = "+i+" x = "+queue.get(i).getX()+" y = "+queue.get(i).getY()+" speed = "+queue.get(i).getSpeed()+"  g =" +queue.get(i).getGvalue() +LINE_BREAK);
					//	gvalue += (float) (1/(queue.get(i).speed));
				}


				//System.out.println(currentGrid);
				//	}

				//System.out.print(currentGrid.speed);
				
				/*if(this.speed<=0)
				{System.out.println("speed decreased under zero");
				break;
				}*/

				//	gvalue = (float) 1/this.speed;
				//gvalue = gvalue+ (float)1/((this.speed*(counterChild*2)));
				currentGrid = queue.removeFirst();
				count++;
				
			} while(currentGrid.getC() != 'G');

			System.out.println("Please check the output file");

			//writer.write("count:" + count + LINE_BREAK);
			//writer.write("x:" + currentGrid.getX() +"," +"y:" + currentGrid.getY() + ",c: " + currentGrid.getC() +LINE_BREAK);
			//writer.write("speed=" +this.speed + "," +"g=" +(1/this.speed) +LINE_BREAK);
			

			Grid temp=currentGrid;
			LinkedList<Grid> rev=new LinkedList<Grid>();
			while(!temp.equals(startNode))
			{
				//System.out.println();
				rev.add(temp);
				temp=temp.getParentNode();
			}
			rev.add(startNode);
			writer.write("Number of Iterations =" +count +LINE_BREAK);
			writer.write("Path Length = " +rev.size() +LINE_BREAK);
			Collections.reverse(rev);

			float  gvalue2 = 0;
			for(int j=0;j<rev.size();j++){

				writer.write("x = "+rev.get(j).getX()+" y = "+rev.get(j).getY()+" speed = "+rev.get(j).getSpeed()+" g = "+gvalue2 +LINE_BREAK);
				gvalue2 += (float) (1/(rev.get(j).speed));
			}
			writer.write("--------------------------------------------------------------------------" +LINE_BREAK);
			writer.write("Search Log"+LINE_BREAK);
		
			writer.write(bfs.toString() +LINE_BREAK);
			writer.close();
		}

		public String getInputFile() {
			return inputFile;
		}

		public void setInputFile(String inputFile) {
			this.inputFile = inputFile;
		}
	}

