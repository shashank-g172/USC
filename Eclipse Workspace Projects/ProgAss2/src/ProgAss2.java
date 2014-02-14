import java.io.BufferedReader;

import java.io.BufferedWriter;
import java.io.DataInputStream;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStreamReader;

import java.util.Collections;
import java.util.Iterator;
import java.util.LinkedList;
import java.util.PriorityQueue;
import java.util.StringTokenizer;

import java.util.Stack;

import javax.print.attribute.ResolutionSyntax;

public class ProgAss2 {

	private String regexOperandWithBrackets=".*?\\s([^AND^OR^NOT^<=>^=>]+)";  // .*?\s([^AON<=]+)
	private String anythingAfterBracket = ".*?\\((.*?)[\\s]+";
	//private String OperatorsWith2Problems = ".*?\s\((.*?)[\s]+";
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

	private String operator;
	private String OpenedBracket = "(";
	private String ClosedBracket = ")";
	private static final String OR = "OR";
	private static final String AND = "AND";
	private static final String DIMP = "<=>";
	private static final String IMP = "=>";
	private static final String NOT = "NOT";

	Stack<String> operandStack = new Stack<String>();
	Stack<String> tempStack = new Stack<String>();

	public void pushtoStack(String character)
	{
		tempStack.push(character);
	}

	public boolean isOperand(String input)
	{
		String operand = input;
		if(!operand.equals(OR) && !operand.equals(AND) && !operand.equals(DIMP) && !operand.equals(IMP) && !operand.equals(NOT))
		{
			return true;
		}
		return false;
	}

	public void EvaluateFunc(String[] tokens, int i)
	{
		//System.out.println("test");
		String currentToken = tokens[i];
		
		int ParaCount=0;
		 
		//int n= tokens.length;
		
		//int i=pos;
		//System.out.println(tokens[1]);
		if(currentToken.contains(OpenedBracket))
					ParaCount++;

				if(currentToken.contains(ClosedBracket))
					ParaCount--;

				int index=0;
				int lastIndex = currentToken.length();
				StringBuilder builder = new StringBuilder();
				if(currentToken.startsWith(OpenedBracket) && (currentToken.endsWith(ClosedBracket)))
				{
						
						String delims1= "( )+";
						String[] temp= currentToken.split(delims1);
						//for(int p=0;p<temp.length;p++)
								//System.out.println(temp[p]+"\n");
						for(int g=temp.length-1;g>=4 ;g--)
							{
									builder.append(temp[g]);
									
									builder.append(" ");
							}
						
							//System.out.println(builder.toString()+"\n");
				}
				
				pushtoStack(builder.toString());
				
				
				System.out.println("pushed " +tempStack.peek());
				
						
				System.out.println("length of pushed thing " +tempStack.peek().length());
				
				
				//continue;
				System.out.println("Count of brackets " + ParaCount);
				
		}


	String delims = "(  )+ ";

	public void createKB()
	{
		try{

			File inputFile=new File(this.inputFile);
			BufferedReader br = new BufferedReader(new FileReader(inputFile));
			String strLine;



			while ((strLine = br.readLine()) != null)   {
				//				String[] test = strLine.split(OperatorsWith2Problems);
				//				for(int j=0;j<test.length;j++)
				//				{ 
				//					pushtoStack(test[j]);
				//					}

				String[] tokens = strLine.split(delims);		
				int pos;
				for(int i=0;i<tokens.length;i++)

					//	System.out.println(tokens[i]);
					this.EvaluateFunc(tokens, i);
				//System.out.println(tokens[i]);


			}
			br.close();
		}catch(Exception e){
			System.out.println("error in file parsing");
			e.printStackTrace();
		}
	}	
	//this.time=0; //print command line arguments, (figure out how)
	//print command line arguments, (figure out how)

	public static void main(String[] args) throws IOException
	{

		ProgAss2 resolution = new ProgAss2();
		//System.out.println("in main");
		String program1 = args[0];
		//System.out.println(program1);

		if(args[1].equals("-task1"))

		{
			//System.out.println("In task1");	
			resolution.setInputFile(args[2]);
			//resolution.setOutputFile(args[3]);
		}
		else if(args[1].equals("-task2"))
		{
			resolution.setInputFile(args[2]);
			resolution.setOutputFile(args[3]);
		}
		else if(args[1].equals("-task3"))
		{
			resolution.setInputFile(args[2]);
			resolution.setStatementInput(args[3]);
			resolution.setOutputFile(args[4]);
		}


		resolution.createKB();
	} 
}


