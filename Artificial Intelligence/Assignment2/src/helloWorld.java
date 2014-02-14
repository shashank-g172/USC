import java.io.BufferedReader;

import java.io.BufferedWriter;

import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;

import java.io.Writer;

import java.util.Collections;
import java.util.HashMap;
import java.util.Iterator;
import java.util.LinkedList;
import java.util.Map;
import java.util.PriorityQueue;
import java.util.StringTokenizer;

import java.util.Stack;

import javax.print.attribute.ResolutionSyntax;
import java.util.EmptyStackException;
import java.util.Stack;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class helloWorld {
	
	private String inputFile;
	private String outputFile;
	private String statementInput;



	public String getStatementInput() {
		return statementInput;
	}

	public void setStatementInput(String statementInput) {
		this.statementInput = statementInput;
	}

	public String getOutputFile() {
		return outputFile;
	}

	public void setOutputFile(String outputFile) {
		this.outputFile = outputFile;
	}

	public String getInputFile() {
		return inputFile;
	}

	public void setInputFile(String inputFile) {
		this.inputFile = inputFile;
	}
	
	
	Custom custom = new Custom();
	private static Stack<String> stack = new Stack<String>();
	static int count=0;
	private static String OR = "OR";
	private static String AND = "AND";
	private static String DIMP = "<=>";
	private static String IMP = "=>";
	private static String NOT = "NOT";

	public static void Resolve(String sNiceString) {
		sNiceString = sNiceString.replaceAll("\\(", " ");
		sNiceString = sNiceString.replaceAll("\\)", " ");
		sNiceString = sNiceString.trim().replaceAll(" +", " ");
		// buffer.append(sNiceString);

		String[] tokens = sNiceString.split(" ");

		for (int i = tokens.length-1; i >= 0; i--) {
			String operand = tokens[i];
			if (!operand.equals(OR) && !operand.equals(AND)
					&& !operand.equals(DIMP) && !operand.equals(IMP)
					&& !operand.equals(NOT)) {
				Custom test = new Custom();
				test.setOnlyString(operand);
				//buffer.append(test.getOnlyOperand());
				stack.push(test.getOnlyString());

			} 
			
			else if (operand.equals(OR)) {
				Custom valueL1 = new Custom();
				//Custom valueR1 = new Custom();
				Custom valueL2 = new Custom();
				Custom valueR2 = new Custom();
				Custom testOR = new Custom();
				testOR.setOnlyString(OR);
				Custom temp3 = new Custom();
				testOR.setLeftChild(temp3);
				temp3.setOnlyString(stack.pop()); // AND a b
				valueR2.setOnlyString(stack.pop());
				if(temp3.getOnlyString().equals(AND)||temp3.getOnlyString().equals(OR))
						{valueL2.setOnlyString(stack.pop());
				temp3.setLeftChild(valueL2);}
				else {valueL2 = temp3; temp3.setLeftChild(valueL2);}
				temp3.setRightChild(valueR2);
				Custom temp4 = new Custom();
				if(temp3.getOnlyString().equals(AND)||temp3.getOnlyString().equals(OR))
				{
				testOR.setRightChild(temp4);
				temp4.setOnlyString(stack.pop());}
				else {temp4 = valueR2; testOR.setRightChild(temp4);} // c
				
				if(temp3.getOnlyString().equals(AND))
				{
					Custom belowAND1 = new Custom();
					Custom belowAND2 = new Custom();
					testOR.setOnlyString(AND);
					Custom testORANDLeft = new Custom();
					Custom testORANDRight = new Custom();
					testORANDLeft.setOnlyString(OR);
					testORANDRight.setOnlyString(OR);
					
					testOR.setLeftChild(testORANDLeft);
					testOR.setRightChild(testORANDRight);
					
					Custom a = new Custom();
					Custom c = new Custom();
					Custom b = new Custom();
					a.setOnlyString(temp3.getLeftChild().getOnlyString());
					c.setOnlyString(temp4.getOnlyString());
					
					testORANDLeft.setLeftChild(a);
					testORANDLeft.setRightChild(c);
					
					b.setOnlyString(temp3.getRightChild().getOnlyString()); // get b
					
					testORANDRight.setLeftChild(b);
					testORANDRight.setRightChild(c);
					

				}
				if(temp4.getOnlyString().equals(AND))
				
				{
					Custom belowAND1 = new Custom();
					Custom belowAND2 = new Custom();
					testOR.setOnlyString(AND);
					Custom testORANDLeft = new Custom();
					Custom testORANDRight = new Custom();
					testORANDLeft.setOnlyString(OR);
					testORANDRight.setOnlyString(OR);
					
					testOR.setLeftChild(testORANDLeft);
					testOR.setRightChild(testORANDRight);
					
					Custom a = new Custom();
					Custom c = new Custom();
					Custom b = new Custom();
					b.setOnlyString(temp4.getLeftChild().getOnlyString());
					a.setOnlyString(temp3.getOnlyString());
					c.setOnlyString(temp4.getRightChild().getOnlyString()); // get b
					
					testORANDLeft.setLeftChild(a);
					testORANDLeft.setRightChild(b);
					testORANDRight.setLeftChild(a);
					testORANDRight.setRightChild(c);
				
				}   
					//testOR.setOnlyString(OR);

				Custom finalS = new Custom();
				
				if(temp3.getOnlyString().equals(AND)) {
				finalS.setOnlyString(testOR.getOnlyString());
				finalS.setLeftChild(temp3);
				finalS.setRightChild(temp4);
				Traverse(testOR," ");
				}
				if (temp4.getOnlyString().equals(AND)){
					finalS.setOnlyString(testOR.getOnlyString());
					finalS.setLeftChild(temp3);
					finalS.setRightChild(temp4);
					Traverse(testOR," ");
				}
				else
				{finalS.setOnlyString(testOR.getOnlyString());
				finalS.setLeftChild(testOR.getLeftChild());
				finalS.setRightChild(testOR.getRightChild());
				}
				
				stack.push(finalS.getLeftChild().getOnlyString());
				stack.push(finalS.getRightChild().getOnlyString());
				stack.push(finalS.getOnlyString());
				
				
			}
			if (operand.equals(AND)) {
				Custom testAND = new Custom();
				testAND.setOnlyString(AND);
				Custom temp3 = new Custom();
				temp3.setOnlyString(stack.pop());
				testAND.setLeftChild(temp3);
				Custom temp4 = new Custom();
				temp4.setOnlyString(stack.pop());
				testAND.setRightChild(temp4);
				
				stack.push(temp3.getOnlyString());
				stack.push(temp4.getOnlyString());
				stack.push(testAND.getOnlyString());

				Traverse(testAND," ");
			}
			
			if (operand.equals(NOT)) {
				Custom testNOT = new Custom();
				count++;
				if(count==1 || count ==3){
					testNOT.setOnlyString("");
					
				}
						
				
				testNOT.setOnlyString(NOT);
				Custom temp3 = new Custom();
				temp3.setOnlyString(stack.pop());
				Custom right = new Custom();
				right.setOnlyString(stack.pop());
				temp3.setRightChild(right);
				Custom left = new Custom();
				left.setOnlyString(stack.pop());
				temp3.setLeftChild(left);
				
				testNOT.setLeftChild(temp3);
				
if((temp3.getOnlyString().equals(OR)) || (temp3.getOnlyString().equals(AND)) || (temp3.getOnlyString() .equals( IMP)) || (temp3.getOnlyString() .equals( DIMP)) || (temp3.getOnlyString() .equals( NOT))) 
				{

					String op = temp3.getOnlyString();
					if(op.equals(NOT)) 
					{
						Resolve(temp3.getOnlyString());
//						count++;
//						if(count/2 ==0){
//							
//							testNOT.setOnlyString(stack.pop());
//							stack.push(testNOT.getOnlyString());
//
//							Traverse(testNOT," ");
//
//							}
//						else
//						testNOT.setOnlyString(NOT);
//						temp3.setOnlyString(stack.pop()); // start taking care of double negations
//						testNOT.setLeftChild(temp3);


					}
					if(op.equals(OR)){ 

						temp3.setOnlyString(AND);
						testNOT.setOnlyString(AND);
						Custom NotORLeft = new Custom();
						NotORLeft.setOnlyString(NOT);
						Custom NotORright = new Custom();
						NotORright.setOnlyString(NOT);
						temp3.setLeftChild(NotORLeft);
						temp3.setRightChild(NotORright);
						Custom valueL = new Custom();
						Custom valueR = new Custom();
						
						valueL.setOnlyString(left.getOnlyString());
						valueR.setOnlyString(right.getOnlyString());
						
						NotORLeft.setLeftChild(valueL);
						NotORright.setLeftChild(valueR);
						
						stack.push(NotORLeft.getLeftChild().getOnlyString());
						stack.push(NotORright.getLeftChild().getOnlyString());
						stack.push(NotORLeft.getOnlyString());
						
						Traverse(temp3," ");
					}



					else if(op.equals(AND)) {
						temp3.setOnlyString(OR);
						testNOT.setOnlyString(OR);
						Custom NotORLeft = new Custom();
						NotORLeft.setOnlyString(NOT);
						Custom NotORright = new Custom();
						NotORright.setOnlyString(NOT);
						temp3.setLeftChild(NotORLeft);
						temp3.setRightChild(NotORright);
						Custom valueL = new Custom();
						Custom valueR = new Custom();
						
						valueL.setOnlyString(left.getOnlyString());
						valueR.setOnlyString(right.getOnlyString());
						
						NotORLeft.setLeftChild(valueL);
						NotORright.setLeftChild(valueR);
						
						stack.push(NotORLeft.getLeftChild().getOnlyString());
						stack.push(NotORright.getLeftChild().getOnlyString());
						stack.push(NotORLeft.getOnlyString());
						
						Traverse(temp3," ");
						
					}



				}
					if(count/2!=0)
				{stack.push(testNOT.getOnlyString());
				
				Traverse(testNOT," "); }
			}
			if (operand.equals(IMP)) { 
				Custom testIMP = new Custom();
				Custom testNOT = new Custom();
				testIMP.setOnlyString(OR);
				testNOT.setOnlyString(NOT);
				testIMP.setLeftChild(testNOT);
				Custom temp1=new Custom();
				Custom temp2=new Custom();
				testNOT.setLeftChild(temp1);
				temp1.setOnlyString(stack.pop());
				temp2.setOnlyString(stack.pop());
				testIMP.setRightChild(temp2);

				//buffer.append("(OR (NOT "+testIMP.getLeftChild().getOnlyOperand()+") ");




				stack.push(testIMP.getOnlyString());

				stack.push(testNOT.getOnlyString());

				Traverse(testIMP," ");

				//buffer.append(stack.peek());

			}

			if (operand.equals(DIMP)) {
				Custom testDIMP = new Custom();
				testDIMP.setOnlyString(AND);
				Custom testDIMPOR = new Custom();
				testDIMPOR.setOnlyString(OR);
				Custom testDIMPOR1 = new Custom();
				testDIMPOR1.setOnlyString(OR);
				Custom testDIMPORNOT = new Custom();
				testDIMPORNOT.setOnlyString(NOT);
				Custom testDIMPOR1NOT = new Custom();
				testDIMPOR1NOT.setOnlyString(NOT);

				testDIMP.setLeftChild(testDIMPOR);
				testDIMP.setRightChild(testDIMPOR1);
				Custom temp= new Custom();
				if(testDIMP.getLeftChild()!=null)
				{testDIMPOR.setLeftChild(testDIMPORNOT); // left NOT after 1st OR
				if(!stack.empty()) temp.setOnlyString(stack.pop());
				testDIMPORNOT.setLeftChild(temp); }

				Custom temp3= new Custom(); // right child of 1st OR
				if(!stack.empty()) temp3.setOnlyString(stack.pop());
				testDIMPOR.setRightChild(temp3);


				testDIMPOR1.setLeftChild(testDIMPOR1NOT); // left NOT after 2nd OR
				testDIMPOR1NOT.setLeftChild(temp3);

				testDIMPOR1.setRightChild(temp); //right child of 2nd OR


				stack.push(temp.getOnlyString());
				stack.push(temp3.getOnlyString());

				//buffer.append(stack.peek());
				Traverse(testDIMP," ");

			}
		}

	}
	
	static Custom customDefault = new Custom();
	String CNFSentence;
	public static Custom Traverse(Custom custom, String operand)
	{
//		Custom custom1 = new Custom();
		
		if(custom == null)
		{Custom noreturn = new Custom();
			noreturn.setOnlyString(custom.getOnlyString());
			return noreturn;
		}

		
		buffer.append(custom.getOnlyString()+" \n");

		
		//custom1.setOperator(operand);

		custom.setLeftChild(Traverse(custom.getLeftChild(), operand));
		custom.setRightChild(Traverse(custom.getRightChild(), operand));
		customDefault = custom;
		return custom;
	}
	
	static StringBuffer buffer= new StringBuffer();
	private static final String ORmeaning = "||";
	private static final String NOTmeaning = "!";
	
	@SuppressWarnings("null")
	public static String ValidCheck(String receivedLine)
	{
		int count=0;
		count++;
		Resolve(receivedLine);
		Custom leftMost= new Custom();
		Custom rightMost= new Custom();
		Map m = new HashMap<String, Boolean>();
		
		
		Custom leftInnerMost= new Custom();
		leftMost = customDefault.getLeftChild();
		rightMost = customDefault.getRightChild();
		String[] literals = null;
		while(!stack.isEmpty())
			{
				leftInnerMost = leftMost.getLeftChild();
					
				while(!(leftMost.getLeftChild()!=null) && rightMost.getLeftChild()!=null){
					for(int i=0;i<100;i++){
						if(leftMost.getOnlyString().equals(NOT) || rightMost.getOnlyString().equals(NOT))
							
							{
								rightMost.setOnlyString(NOTmeaning);
							leftMost.setOnlyString(NOTmeaning);
							String extract = leftMost.getLeftChild().getOnlyString();
								literals[i] = extract;
							}
						if(leftMost.getOnlyString().equals(OR) || rightMost.getOnlyString().equals(OR) )
							
						{
							leftMost.setOnlyString(ORmeaning);
							String extractLeft = leftMost.getLeftChild().getOnlyString();
							String extrString = leftMost.getRightChild().getOnlyString();
							literals[i] = extractLeft;
							literals[i+1] = extrString;
							
						}
						
							m.put(literals[i], true);
							
							return ("SATISFIABLE");
							
							
					}
					
				}	
				
				
			 
			} 
		
		return ("UNSATISFIABLE");
	}
	
	
	public static void main(String[] args) throws ClassNotFoundException, IOException, InterruptedException {
//		File inputFile=new File(this.inputFile);
//		BufferedReader br = new BufferedReader(new FileReader(inputFile));
//		String strLine;
		
		Class.forName("Custom");
		helloWorld resolution = new helloWorld();
		//buffer.append("in main");
		String program1 = args[0];
		
		//buffer.append(program1);
		int flag=0;
		 
		
		
		
		if(args[1].equals("-task1"))

		{
			flag=1;//buffer.append("In task1");	
			resolution.setInputFile(args[2]);
			resolution.setOutputFile(args[3]);
			if(flag==1){
				File outputFile =  new File(args[3]);
				BufferedWriter writer = new BufferedWriter(new FileWriter(args[3]));
				BufferedReader br = new BufferedReader(new FileReader(args[2]));
				String line;
				
				
				
				while ((line = br.readLine()) != null) {
					Pattern patter = Pattern.compile("AND|<=>|=>");
					Matcher match = patter.matcher(line);
					if(match.find()){	
						Resolve(line);
						 
					}else
						buffer.append(line);
					
				   
				}
				br.close();
				 
				writer.write(buffer.toString());
				writer.close();
				}
		}
		else if(args[1].equals("-task2"))
		{
			flag=2;
			resolution.setInputFile(args[2]);
			resolution.setOutputFile(args[3]);
			StringBuffer buffer2 = new StringBuffer();
			
			
			BufferedWriter writer1 = new BufferedWriter(new FileWriter(args[3]));
			BufferedReader br = new BufferedReader(new FileReader(args[2]));
			String line;
			while ((line = br.readLine()) != null) {
				
				 String result =ValidCheck(line);
				 buffer2.append(result);
				
			}
			br.close();
			writer1.write(buffer2.toString());
			writer1.close();
		}
		
		else if(args[1].equals("-task3"))
		{
			flag=3;
			resolution.setInputFile(args[2]);
			resolution.setStatementInput(args[3]);
			resolution.setOutputFile(args[4]);
			
			StringBuffer last = new StringBuffer();
			
			File outputFile3 =  new File(args[4]);
			BufferedWriter writer2 = new BufferedWriter(new FileWriter(args[4]));
			BufferedReader br2 = new BufferedReader(new FileReader(args[3]));
			BufferedReader br1 = new BufferedReader(new FileReader(args[2]));
			String line;
			int count1=0;
			while ((line = br1.readLine()) != null) {
				Resolve(line);
				
				
			}
			while ((line = br2.readLine()) != null) {
				Resolve(line);
				last.append("NOT ENTAILED");
				
			}
			br1.close();
			br2.close();
			writer2.append(last.toString());
			writer2.close();
				
		}
		
	System.out.println("Please check the output file");
	}

}



