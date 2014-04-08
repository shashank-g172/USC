import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.util.Collections;
import java.util.LinkedList;

public class PropositionalLogic 
{
	/**
	 * Main program starts
	 */
	public static void main(String[] args) 
	{
		String path=new String("src/");
		LinkedList<String> KB=new LinkedList<String>();
		LinkedList<String> alpha=new LinkedList<String>();		
		String kb_str1,kb_str2,kb_str3,alpha_str1,alpha_str2,alpha_str3;
		String inp1_filename,inp2_filename,out_filename;
		StringBuffer statement=new StringBuffer();
		StringBuffer answer= new StringBuffer();
		StringBuffer result= new StringBuffer();
		BufferedReader br;
		boolean valid=true;
		//long startTime=0,endTime=0,totalTime=0;
		
		try
		{
			if(args[0].equals("-task1"))
			{
				inp1_filename=new String(path+args[1]);
				br=new BufferedReader(new FileReader(inp1_filename));
				while((kb_str1=br.readLine())!=null)
				{
					kb_str2=kb_str1.replaceAll("\\(","\\( ");
					kb_str3=kb_str2.replaceAll("\\)"," \\)");
					convert_to_CNF_part1(kb_str3,KB);
				}	
				br.close();
				convert_to_CNF_part2(KB);
				for(int i=0;i<KB.size();i++)
					result.append(KB.get(i)+"\n");
				display(KB,"KB in CNF:");
				out_filename=new String(path+args[2]);
				write_it_to_file(result,out_filename);
			}

			else if(args[0].equals("-task2"))
			{
				inp1_filename=new String(path+args[1]);
				br=new BufferedReader(new FileReader(inp1_filename));
				while((kb_str1=br.readLine())!=null)
				{
					kb_str2=kb_str1.replaceAll("\\(","\\( ");
					kb_str3=kb_str2.replaceAll("\\)"," \\)");
					convert_to_CNF_part1(kb_str3,KB);
				}	
				br.close();
				convert_to_CNF_part2(KB);
				//display(KB,"KB in CNF:");
				for(int i=0;i<KB.size();i++)
				{
					valid=check_if_valid(KB.get(i));
					if(!valid)
						break;
				}
				if(!valid)
				{
					remove_always_true(KB);
					result.append(pl_resolution(KB,alpha));
					if(result.toString().equals("Entailed"))
					{
						result.delete(0,result.length());
						result.append("Unsatisfiable\n");
					}
					else if(result.toString().equals("Not entailed"))
					{
						result.delete(0,result.length());
						result.append("Satisfiable\n");
					}
				}
				else
					result.append("Valid\n");
				out_filename=new String(path+args[2]);
				System.out.println("KB is : "+result);
				write_it_to_file(result,out_filename);
			}

			else if(args[0].equals("-task3"))
			{
				inp1_filename=new String(path+args[1]);				
				br=new BufferedReader(new FileReader(inp1_filename));	
				while((kb_str1=br.readLine())!=null)
				{
					kb_str2=kb_str1.replaceAll("\\(","\\( ");
					kb_str3=kb_str2.replaceAll("\\)"," \\)");
					convert_to_CNF_part1(kb_str3,KB);
				}	
				br.close();
				convert_to_CNF_part2(KB);
				remove_always_true(KB);
				//display(KB,"KB in CNF");
				
				inp2_filename=new String(path+args[2]);
				br=new BufferedReader(new FileReader(inp2_filename));
				result.delete(0,result.length());
				while((alpha_str1=br.readLine())!=null)
				{
					alpha.clear();
					System.out.println(alpha_str1);
					alpha_str2=alpha_str1.replaceAll("\\(","\\( ");
					alpha_str3=alpha_str2.replaceAll("\\)"," \\)");
					statement.delete(0, statement.length());
					statement.append("( NOT "+alpha_str3+" )");
					convert_to_CNF_part1(statement.toString(),alpha);
					convert_to_CNF_part2(alpha);
					remove_always_true(alpha);
					answer.delete(0,answer.length());
					answer.append(pl_resolution(KB,alpha));
					result.append(answer+"\n");
					System.out.println(answer+"\n");
					//System.out.println(result);
				}
				out_filename=new String(path+args[3]);
				write_it_to_file(result,out_filename);
			}
		}
		catch (Exception ex)
		{
			ex.printStackTrace();
		}

	}

	public static void display(LinkedList<String> storage,String str) 
	{
		for(int i=0;i<storage.size();i++)
			System.out.println(str+" "+storage.get(i));
		return;
	}


	public static boolean check_if_valid(String clause) 
	{
		boolean valid=false;
		StringBuffer c1=new StringBuffer(clause);
		StringBuffer lit1=new StringBuffer();
		StringBuffer lit2=new StringBuffer();
		LinkedList<String> c1_literals=new LinkedList<String>();

		get_literals(c1, c1_literals);
		for(int i=0;i<c1_literals.size()-1;i++)
		{
			lit1.delete(0, lit1.length());
			lit1.append(c1_literals.get(i));
			for(int j=i+1;j<c1_literals.size();j++)
			{
				lit2.delete(0, lit2.length());
				lit2.append(c1_literals.get(j));
				valid=check_if_complmentary_literals(lit1, lit2);
				if(valid)
					break;
			}
			if(valid)
				break;
		}
		return valid;
	}


	public static void write_it_to_file(StringBuffer result,String out_filename)
	{
		try
		{
			File file = new File(out_filename);
			if (!file.exists()) 
				file.createNewFile();

			FileWriter fw = new FileWriter(file.getAbsoluteFile());
			BufferedWriter bw = new BufferedWriter(fw);
			bw.write(result.toString());
			bw.close();
		}
		catch (Exception ex)
		{
			ex.printStackTrace();
		}
		return;
	}

	public static StringBuffer pl_resolution(LinkedList<String> KB,LinkedList<String> alpha) 
	{
		StringBuffer resolvents=new StringBuffer();
		StringBuffer result=new StringBuffer();
		StringBuffer c1=new StringBuffer();
		StringBuffer c2=new StringBuffer();
		//LinkedList<String> gen=new LinkedList<String>();
		LinkedList<String> clauses= new LinkedList<String>();
		LinkedList<String> recent=new LinkedList<String>();
		boolean do_loop=false,added=false,contains=true;
		long startTime=0,endTime=0,totalTime=0;
		//sint index=0;

		for(int i=0;i<KB.size();i++)
		{
			clauses.add(KB.get(i));
			//gen.add(KB.get(i));
		}
		for(int i=0;i<alpha.size();i++)
		{
			clauses.add(alpha.get(i));
			//gen.add(alpha.get(i));
		}
		startTime   = System.currentTimeMillis();

		while(true)
		{
			do_loop=false;
			recent.clear();
			for(int i=0;i<clauses.size()-1;i++)
			{
				c1.delete(0, c1.length());
				c1.append(clauses.get(i).trim());
				for(int j=i+1;j<clauses.size();j++)
				{
					contains=true;
					c2.delete(0, c2.length());
					c2.append(clauses.get(j).trim());
					contains=has_comp_literals(c1,c2);
					if(contains)
					{
						//System.out.println("resolve "+c1+" with "+c2);
						added=false;
						resolvents.delete(0, resolvents.length());
						resolvents.append(resolve(c1,c2));
						if((resolvents.toString().equals("BLANK"))||(resolvents.toString().equals(" "))||(resolvents.toString().equals("")))
						{
							result.delete(0,result.length());
							result.append("Entailed");
							clauses.clear();
							recent.clear();
							return result;
						}
						remove_unwanted_paranthesis(resolvents);
						remove_unwanted_brackets(resolvents);
							recent.add(resolvents.toString().trim());
					}
				}
			}
			Collections.sort(recent);
			for(int p=0;p<recent.size()-1;p++)
			{
				if(recent.get(p).equals(recent.get(p+1).toString().trim()))
				{
					recent.remove(p);
					p--;
				}
					
			}
			
			for(int p=0;p<recent.size();p++)
			{
				resolvents.delete(0, resolvents.length());
				resolvents.append(recent.get(p));
				if(has_comp_literals(resolvents, resolvents))
				{
					recent.remove(p);
					p--;
				}
			}
			//gen.clear();	
			for(int p=0;p<recent.size();p++)
			{
				if(!is_recent_is_subset_of_clauses(recent.get(p),clauses))
				{
					do_loop=true;
					clauses.add(recent.get(p));
					//gen.add(recent.get(p));
				}
			}
			if(!do_loop)
			{
				result.delete(0,result.length());
				result.append("Not entailed");
				clauses.clear();
				recent.clear();
				break;
			}
			endTime   = System.currentTimeMillis();
			totalTime = endTime - startTime;
			if(totalTime>300000)
			{
				result.delete(0, result.length());
				result.append("Not entailed");
				break;
			}
		}
		return result;
	}

	public static boolean has_comp_literals(StringBuffer c1, StringBuffer c2) 
	{
		boolean contains=false,comp=false;
		LinkedList<String> c1_literals=new LinkedList<String>();
		LinkedList<String> c2_literals=new LinkedList<String>();
		StringBuffer lit1=new StringBuffer();
		StringBuffer lit2=new StringBuffer();

		get_literals(c1, c1_literals);
		get_literals(c2, c2_literals);
		for(int i=0;i<c1_literals.size();i++)
		{
			lit1.delete(0, lit1.length());
			lit1.append(c1_literals.get(i));
			for(int j=0;j<c2_literals.size();j++)
			{
				lit2.delete(0, lit2.length());
				lit2.append(c2_literals.get(j));
				comp=check_if_complmentary_literals(lit1, lit2);
				if(comp)
				{
					contains=true;
					break;
				}
			}
			if(contains)
				break;
		}
		c1_literals.clear();
		c2_literals.clear();
		return contains;
	}

	public static void is_it_always_true(LinkedList<String> storage) 
	{
		StringBuffer statement=new StringBuffer();
		StringBuffer result=new StringBuffer();

		for(int i=0;i<storage.size();)
		{
			statement.delete(0, statement.length());
			statement.append(storage.get(i));
			result.delete(0,result.length());
			result.append(evaluate_if_always_true(statement));
			if(result.toString().equals("TRUE"))
			{
				storage.remove(i);
			}
			else
				i++;
		}
		return;
	}

	public static StringBuffer evaluate_if_always_true(StringBuffer statement) 
	{
		LinkedList<String> literals=new LinkedList<String>();
		StringBuffer c1=new StringBuffer();
		StringBuffer c2=new StringBuffer();
		StringBuffer result=new StringBuffer(statement);

		get_literals(statement, literals);
		for(int i=0;i<literals.size()-1;i++)
		{
			c1.delete(0, c1.length());
			c1.append(literals.get(i));
			for(int j=i+1;j<literals.size();j++)
			{
				c2.delete(0, c2.length());
				c2.append(literals.get(j));
				if(check_if_complmentary_literals(c1, c2))
				{
					result.delete(0, result.length());
					result.append("TRUE");
					return result;
				}
			}
		}
		literals.clear();
		return result;
	}

	public static boolean is_recent_is_subset_of_clauses(String str,LinkedList<String> clauses) 
	{
		boolean subset=false;
		StringBuffer recent=new StringBuffer(str);
		for(int i=0;i<clauses.size();i++)
		{
			if(clauses.get(i).equals(recent.toString().trim()))
			{
				subset=true;
				break;
			}
			else
				subset=false;

		}
		return subset;
	}

	public static void remove_unwanted_brackets(StringBuffer statement) 
	{
		LinkedList<String> tokenValue=new LinkedList<String>();
		LinkedList<String> tokenType=new LinkedList<String>();
		tokenValue.clear();tokenType.clear();
		split_into_tokens(tokenValue,statement);
		classify_tokens_based_on_type(tokenValue, tokenType);

		for(int j=0;j<tokenType.size()-3;j++)
		{
			if((tokenType.get(j).equals("("))&&(tokenType.get(j+1).equals("LIT"))&&(tokenType.get(j+2).equals(")")))
			{
				tokenValue.remove(j);
				tokenType.remove(j);
				tokenValue.remove(j+1);
				tokenType.remove(j+1);
			}
		}
		combine_tokens(tokenValue, statement);
		tokenValue.clear();
		tokenType.clear();
		return;

	}

	public static StringBuffer resolve(StringBuffer str1, StringBuffer str2) 
	{
		StringBuffer result=new StringBuffer();
		StringBuffer clause1=new StringBuffer(str1);
		StringBuffer clause2=new StringBuffer(str2);
		StringBuffer c1=new StringBuffer();
		StringBuffer c2=new StringBuffer();
		LinkedList<String> c1_literals = new LinkedList<String>();
		LinkedList<String> c2_literals = new LinkedList<String>();
		LinkedList<String> tmp=new LinkedList<String>();
		LinkedList<String> combined=new LinkedList<String>();
		boolean resolve=false,same=false;

		get_literals(clause1,c1_literals);
		get_literals(clause2,c2_literals);	
		for(int i=0;i<c1_literals.size();i++)
		{
			c1.delete(0, c1.length());
			c1.append(c1_literals.get(i));
			resolve=false;
			for(int j=0;j<c2_literals.size();)
			{
				c2.delete(0, c2.length());
				c2.append(c2_literals.get(j));
				resolve=check_if_complmentary_literals(c1,c2);
				if(resolve)
				{
					c1_literals.remove(i);
					c2_literals.remove(j);
					break;
				}
				else
				{
					same=check_if_same_literals(c1,c2);
					if(same)
						c2_literals.remove(j);
					else
						j++;
				}
			}
			if(resolve)
				break;
		}
		for(int i=0;i<c1_literals.size();i++)
		{
			tmp.add(c1_literals.get(i).toString().trim());
		}
		c1_literals.clear();
		for(int i=0;i<c2_literals.size();i++)
		{
			tmp.add(c2_literals.get(i).toString().trim());
		}

		c2_literals.clear();
		Collections.sort(tmp);
		for(int i=0;i<tmp.size()-1;i++)
		{

			if(tmp.get(i).equals(tmp.get(i+1).toString()))
			{
				tmp.remove(i);
				i--;
			}
			else
				combined.add("( "+tmp.get(i)+" )");
		}
		if(tmp.size()>0)
			combined.add("( "+tmp.get(tmp.size()-1)+" )");
		tmp.clear();
		if(combined.size()>0)
		{
			for(int i=0;i<combined.size()-1;i++)
			{
				result.append("( OR "+combined.get(i)+" ");
			}
			result.append(" "+combined.get(combined.size()-1));
			for(int i=0;i<combined.size()-1;i++)
				result.append(" )");
		}
		else
			result.append("BLANK");
		c1_literals.clear();
		c2_literals.clear();
		combined.clear();
		return result;
	}

	public static boolean check_if_same_literals(StringBuffer c1, StringBuffer c2) 
	{
		StringBuffer tmp1=new StringBuffer(c1);
		StringBuffer tmp2=new StringBuffer(c2);
		boolean same=false;
		if(tmp1.toString().equals(tmp2.toString()))
			same=true;

		return same;
	}

	public static boolean check_if_complmentary_literals(StringBuffer c1, StringBuffer c2) 
	{
		StringBuffer tmp1=new StringBuffer(c1);
		StringBuffer tmp2=new StringBuffer(c2);
		boolean negation=false;
		tmp1.insert(0, "NOT ");
		if(tmp1.toString().equals(tmp2.toString()))
			negation=true;
		else
		{
			tmp1.delete(0, tmp1.length());
			tmp1.append(c1);
			tmp2.insert(0, "NOT ");
			if(tmp2.toString().equals(tmp1.toString()))
				negation=true;
		}
		return negation;
	}

	public static void get_literals(StringBuffer clause,LinkedList<String> clause_literals)
	{
		StringBuffer statement=new StringBuffer();
		StringBuffer operand= new StringBuffer();

		split_into_tokens(clause_literals, clause);
		for(int i=0;i<clause_literals.size();)
		{
			if((clause_literals.get(i).equals("("))||(clause_literals.get(i).equals("OR"))||(clause_literals.get(i).equals(")"))||(clause_literals.get(i).matches("[ \\t\\n\\r]+")))
				clause_literals.remove(i);
			else
				i++;
		}
		if(clause_literals.size()>0)
		{
			for(int i=0;i<clause_literals.size();i++)
			{
				if(clause_literals.get(i).equals("NOT"))
				{
					operand.delete(0, operand.length());
					operand.append("NOT "+clause_literals.get(i+1));
					clause_literals.remove(i);
					clause_literals.remove(i);
					clause_literals.add(i,operand.toString());
				}
			}
			combine_tokens(clause_literals, statement);
		}
		else
		{
			statement.delete(0, statement.length());
			statement.append("BLANK");
		}
		return;
	}

	public static void convert_to_CNF_part1(String line,LinkedList<String> storage)
	{
		StringBuffer statement=new StringBuffer(line);
		StringBuffer result=new StringBuffer();
		result.delete(0, result.length());
		result.append(remove_unwanted_paranthesis(statement));
		statement.delete(0, statement.length());
		statement.append(result);
		result.delete(0, result.length());

		result.append(remove_bi_conditional(statement));
		statement.delete(0, statement.length());
		statement.append(result);
		result.delete(0, result.length());

		result.append(remove_unwanted_paranthesis(statement));
		statement.delete(0, statement.length());
		statement.append(result);
		result.delete(0, result.length());

		result.append(remove_single_conditional(statement));
		statement.delete(0, statement.length());
		statement.append(result);
		result.delete(0, result.length());

		result.append(remove_unwanted_paranthesis(statement));
		statement.delete(0, statement.length());
		statement.append(result);
		result.delete(0, result.length());

		result.append(expand_NOT(statement));
		statement.delete(0, statement.length());
		statement.append(result);
		result.delete(0, result.length());

		result.append(remove_unwanted_paranthesis(statement));
		statement.delete(0, statement.length());
		statement.append(result);
		result.delete(0, result.length());

		if(!storage.contains(statement.toString()))
			storage.add(statement.toString());
		return ;
	}

	public static void convert_to_CNF_part2(LinkedList<String> storage)
	{
		StringBuffer statement=new StringBuffer();
		StringBuffer result=new StringBuffer();
		LinkedList<String> tokens=new LinkedList<String>();		

		divide_into_clauses(storage);	
		for(int i=0;i<storage.size();i++)
		{
			statement.delete(0, statement.length());
			statement.append(storage.get(i));
			split_into_tokens(tokens,statement);
			while(tokens.contains("AND"))
			{
				result.delete(0, result.length());
				result.append(distribute_OR(statement));
				statement.delete(0, statement.length());
				statement.append(result);

				remove_unwanted_paranthesis(statement);
				storage.remove(i);
				if(!storage.contains(statement.toString()))
					storage.add(i,statement.toString());
				divide_into_clauses(storage);
				statement.delete(0, statement.length());
				statement.append(storage.get(i));
				tokens.clear();
				split_into_tokens(tokens,statement);
			}
		}
		remove_unwanted_braces(storage);
		add_braces_at_start(storage);
		remove_if_two_operands_are_same(storage);
		//remove_always_true(storage);
		tokens.clear();
		return;
	}


	public static void remove_if_two_operands_are_same(LinkedList<String> storage) 
	{
		StringBuffer statement=new StringBuffer();
		StringBuffer result=new StringBuffer();

		for(int i=0;i<storage.size();i++)
		{
			statement.delete(0, statement.length());
			statement.append(storage.get(i));

			result.delete(0, result.length());
			result.append(evaluate_stmt_if_same(statement));
			statement.delete(0, statement.length());
			statement.append(result);

			storage.remove(i);
			if (!storage.contains(statement.toString()))
				storage.add(i, statement.toString());
		}
		return;
	}

	public static StringBuffer evaluate_stmt_if_same(StringBuffer statement) 
	{
		StringBuffer result=new StringBuffer();
		StringBuffer op1=new StringBuffer();
		StringBuffer op2=new StringBuffer();
		StringBuffer new_op1=new StringBuffer();
		StringBuffer new_op2=new StringBuffer();
		LinkedList<String> tokens=new LinkedList<String>();
		LinkedList<String> op1_tokens=new LinkedList<String>();
		LinkedList<String> op2_tokens=new LinkedList<String>();
		int opr_index=0,op1_end_index=0;//op2_end_index=0;

		split_into_tokens(tokens, statement);
		if(tokens.contains("OR"))
		{
			opr_index=tokens.indexOf("OR");
			op1_end_index=get_operand(tokens, opr_index+1, op1);
			get_operand(tokens, op1_end_index+1, op2);
			split_into_tokens(op1_tokens, op1);
			if(op1_tokens.contains("OR"))
			{
				new_op1.delete(0, new_op1.length());
				new_op1.append(evaluate_stmt_if_same(op1));
				op1.delete(0, op1.length());
				op1.append(new_op1);
			}
			split_into_tokens(op2_tokens, op2);
			if(op2_tokens.contains("OR"))
			{
				new_op2.delete(0, new_op2.length());
				new_op2.append(evaluate_stmt_if_same(op2));
				op2.delete(0, op2.length());
				op2.append(new_op2);
			}

			StringBuffer old_op1=new StringBuffer(op1);
			StringBuffer old_op2=new StringBuffer(op2);

			new_op1.delete(0, new_op1.length());
			new_op1.append(remove_all_braces(op1));
			op1.delete(0, op1.length());
			op1.append(new_op1);

			new_op1.delete(0, new_op1.length());
			new_op2.append(remove_all_braces(op2));
			op2.delete(0, op2.length());
			op2.append(new_op2);

			if(op1.toString().equals(op2.toString()))
			{
				statement.delete(0, statement.length());
				statement.append(old_op1);
			}
			else
			{
				statement.delete(0, statement.length());
				statement.append("( OR "+old_op1+" "+old_op2+" )");
			}
		}
		result.append(statement);
		tokens.clear();
		op1_tokens.clear();
		op2_tokens.clear();
		return result;
	}

	public static void remove_always_true(LinkedList<String> storage) 
	{
		StringBuffer statement=new StringBuffer();
		StringBuffer result=new StringBuffer();

		for(int i=0;i<storage.size();)
		{
			statement.delete(0,statement.length());
			statement.append(storage.get(i));

			result.delete(0, result.length());
			result.append(evaluate_stmt_if_true(statement));
			statement.delete(0, statement.length());
			statement.append(result);

			if(statement.toString().equals("TRUE"))
			{
				storage.remove(i);
			}
			else
				i++;
		}
		return;
	}

	public static StringBuffer evaluate_stmt_if_true(StringBuffer statement) 
	{
		StringBuffer result=new StringBuffer();
		StringBuffer op1=new StringBuffer();
		StringBuffer op2=new StringBuffer();
		StringBuffer new_op1=new StringBuffer();
		StringBuffer new_op2=new StringBuffer();

		LinkedList<String> tokens=new LinkedList<String>();
		LinkedList<String> op1_tokens=new LinkedList<String>();
		LinkedList<String> op1_tokenType=new LinkedList<String>();
		LinkedList<String> op2_tokens=new LinkedList<String>();
		int opr_index=0,op1_end_index=0;//op2_end_index=0;
		boolean flag= true,distributed=false;

		split_into_tokens(tokens, statement);
		if(tokens.contains("OR"))
		{
			opr_index=tokens.indexOf("OR");
			op1_end_index=get_operand(tokens, opr_index+1, op1);
			get_operand(tokens, op1_end_index+1, op2);
			split_into_tokens(op1_tokens, op1);
			if(op1_tokens.contains("OR"))
			{
				new_op1.delete(0, new_op1.length());
				new_op1.append(evaluate_stmt_if_true(op1));
				op1.delete(0, op1.length());
				op1.append(new_op1);
			}
			else
			{
				distributed=check_if_NOT_already_distributed(op1);
				op1_tokens.add(0,"(");
				op1_tokens.add(1,"NOT");
				op1_tokens.add(")");
				classify_tokens_based_on_type(op1_tokens, op1_tokenType);				
				if(!distributed)
				{
					distribute_NOT(op1_tokens, op1_tokenType, 1);
				}				
				combine_tokens(op1_tokens, op1);
			}
			split_into_tokens(op2_tokens, op2);
			if(op2_tokens.contains("OR"))
			{
				new_op2.delete(0, new_op2.length());
				new_op2.append(evaluate_stmt_if_true(op2));
				op2.delete(0, op2.length());
				op2.append(new_op2);
			}
			if((op1.toString().equals("TRUE"))||(op2.toString().equals("TRUE")))
			{
				statement.delete(0, statement.length());
				statement.append("TRUE");
				flag=true;
			}
			else
				flag=false;
			if(!flag)
			{
				new_op1.delete(0, new_op1.length());
				new_op1.append(remove_all_braces(op1));
				op1.delete(0, op1.length());
				op1.append(new_op1);

				new_op2.delete(0, new_op2.length());
				new_op2.append(remove_all_braces(op2));
				op2.delete(0, op2.length());
				op2.append(new_op2);

				if(op1.toString().equals(op2.toString()))
				{
					statement.delete(0, statement.length());
					statement.append("TRUE");
				}
			}
		}
		result.append(statement);
		tokens.clear();
		op1_tokens.clear();
		op1_tokenType.clear();
		op2_tokens.clear();
		return result;

	}

	public static StringBuffer remove_all_braces(StringBuffer line) 
	{
		LinkedList<String> tokens=new LinkedList<String>();

		split_into_tokens(tokens, line);
		for(int i=0;i<tokens.size();)
		{
			if((tokens.get(i).equals("("))||(tokens.get(i).equals(")")))
				tokens.remove(i);
			else
				i++;
		}
		combine_tokens(tokens, line);
		tokens.clear();
		return line;
	}

	public static void add_braces_at_start(LinkedList<String> storage) 
	{
		LinkedList<String> tokenValue=new LinkedList<String>();
		StringBuffer statement=new StringBuffer();

		for(int i=0;i<storage.size();i++)
		{
			statement.delete(0, statement.length());
			statement.append(storage.get(i));
			tokenValue.clear();
			split_into_tokens(tokenValue,statement);
			if(!tokenValue.get(0).equals("("))
			{
				tokenValue.add(0,"(");
				tokenValue.add(")");
			}
			combine_tokens(tokenValue, statement);
			storage.remove(i);
			storage.add(i,statement.toString());
		}
		tokenValue.clear();
		return;
	}

	public static void remove_unwanted_braces(LinkedList<String> storage) 
	{
		LinkedList<String> tokenValue=new LinkedList<String>();
		LinkedList<String> tokenType=new LinkedList<String>();
		StringBuffer statement=new StringBuffer();

		for(int i=0;i<storage.size();i++)
		{
			statement.delete(0, statement.length());
			statement.append(storage.get(i));
			tokenValue.clear();tokenType.clear();
			split_into_tokens(tokenValue,statement);
			classify_tokens_based_on_type(tokenValue, tokenType);

			for(int j=0;j<tokenType.size()-3;j++)
			{
				if((tokenType.get(j).equals("("))&&(tokenType.get(j+1).equals("LIT"))&&(tokenType.get(j+2).equals(")")))
				{
					tokenValue.remove(j);
					tokenType.remove(j);
					tokenValue.remove(j+1);
					tokenType.remove(j+1);
				}
			}
			combine_tokens(tokenValue, statement);
			storage.remove(i);
			storage.add(i,statement.toString());
		}
		tokenValue.clear();
		tokenType.clear();
		return;
	}

	public static StringBuffer remove_single_conditional(StringBuffer statement) 
	{
		LinkedList<String> tokenValue=new LinkedList<String>();
		LinkedList<String> tokenType=new LinkedList<String>();

		split_into_tokens(tokenValue,statement);
		while(tokenValue.contains("=>"))
		{
			remove_implication(tokenValue,tokenType);
		}
		combine_tokens(tokenValue,statement);

		tokenType.clear();
		tokenValue.clear();
		return statement;
	}

	public static StringBuffer remove_bi_conditional(StringBuffer statement) 
	{
		LinkedList<String> tokenValue=new LinkedList<String>();
		LinkedList<String> tokenType=new LinkedList<String>();

		split_into_tokens(tokenValue,statement);
		while(tokenValue.contains("<=>"))
		{
			remove_double_implication(tokenValue,tokenType);
		}
		combine_tokens(tokenValue,statement);

		tokenType.clear();
		tokenValue.clear();
		return statement;
	}

	public static void divide_into_clauses(LinkedList<String> storage) 
	{
		boolean divide=true;
		for(int i=0;i<storage.size();i++)
		{
			divide=true;
			while(divide)
				divide=divide_KB_into_clauses(storage, i);
		}
		return;
	}

	public static StringBuffer expand_NOT(StringBuffer statement)
	{
		LinkedList<String> tokenValue=new LinkedList<String>();
		LinkedList<String> tokenType =new LinkedList<String>();
		StringBuffer check_op1=new StringBuffer();
		int currentIndexNOT,prevIndexNOT;
		boolean distributed=false;

		split_into_tokens(tokenValue, statement);
		classify_tokens_based_on_type(tokenValue, tokenType);
		prevIndexNOT=0;
		while(true)
		{
			currentIndexNOT=-1;
			for (int i=prevIndexNOT;i<tokenValue.size();i++)
			{
				if(tokenValue.get(i).equals("NOT"))
				{
					currentIndexNOT=i;
					break;
				}
			}
			if(currentIndexNOT==-1)
				break;
			check_op1.delete(0,check_op1.length());
			get_operand(tokenValue, currentIndexNOT+1, check_op1);
			distributed=check_if_NOT_already_distributed(check_op1);
			if(!distributed)
			{
				distribute_NOT(tokenValue,tokenType, currentIndexNOT);
				combine_tokens(tokenValue, statement);
			}
			prevIndexNOT=currentIndexNOT+1;
		}

		tokenType.clear();
		tokenValue.clear();
		return statement;
	}

	public static boolean divide_KB_into_clauses(LinkedList<String> KB, int index) 
	{
		boolean divide=false;
		StringBuffer line=new StringBuffer(KB.get(index));
		LinkedList<String> tokens=new LinkedList<String>();
		StringBuffer op1=new StringBuffer();
		StringBuffer op2=new StringBuffer();
		int end=0,i=0,count=0,op1_end_index=0;//op2_end_index=0;

		split_into_tokens(tokens, line);
		if((end=(tokens.indexOf("AND")))!=-1)
		{
			for(i=0;i<end;i++)
			{
				if(tokens.get(i).equals("("))
				{
					count++;
				}
				else if(tokens.get(i).equals(")"))
				{
					count--;
				}		
			}
			if(count==1)
			{
				op1_end_index=get_operand(tokens, end+1, op1);
				get_operand(tokens, op1_end_index+1, op2);
				KB.remove(index);
				if (!KB.contains(op1.toString()))
					KB.add(index,op1.toString());
				if (!KB.contains(op2.toString()))
					KB.add(index+1,op2.toString());
				divide=true;
			}
		}

		tokens.clear();
		return divide;
	}

	public static StringBuffer remove_unwanted_paranthesis(StringBuffer line)
	{
		LinkedList<String> tokens=new LinkedList<String>();
		int i=0,start=0,end=0;
		boolean unwanted=true;

		while(unwanted)
		{
			tokens.clear();
			split_into_tokens(tokens, line);
			for(i=0;i<tokens.size()-1;i++)
			{
				if((tokens.get(i).equals("("))&&(tokens.get(i+1).equals("(")))
				{
					start=i;
					end=find_matching_end(tokens,i);
					unwanted=true;
					break;
				}
				else
					unwanted=false;
			}
			if(unwanted)
			{
				tokens.remove(start);
				tokens.remove(end-1);
			}
			combine_tokens(tokens, line);
		}
		tokens.clear();
		return line;
	}

	public static int find_matching_end(LinkedList<String> tokens, int index)
	{
		int count=0,i=0;
		for (i=index;i<tokens.size();i++)
		{
			if(tokens.get(i).equals("("))
				count++;
			if(tokens.get(i).equals(")"))
			{
				count--;
				if(count==0)
					break;
			}
		}
		return i;
	}

	public static boolean check_if_NOT_already_distributed( StringBuffer statement) 
	{
		LinkedList<String> op_token_value=new LinkedList<String>();
		LinkedList<String> op_token_type=new LinkedList<String>();
		String first,second,third;
		boolean distributed=false;

		split_into_tokens(op_token_value,statement);
		classify_tokens_based_on_type(op_token_value, op_token_type);

		first=op_token_type.get(0);
		if(first.equals("LIT"))
			distributed=true;
		if((first.equals("(")))
		{
			second=op_token_type.get(1);
			third=op_token_type.get(2);
			if((second.equals("LIT"))&&(third.equals(")")))
				distributed=true;
		}
		op_token_value.clear();
		op_token_type.clear();
		return distributed;
	}

	public static void classify_tokens_based_on_type(LinkedList<String> tokenValue,LinkedList<String> tokenType) 
	{
		tokenType.clear();
		for(int i=0;i<tokenValue.size();i++)
		{
			if(tokenValue.get(i).equals("("))
				tokenType.add("(");
			else if(tokenValue.get(i).equals(")"))
				tokenType.add(")");
			else if(tokenValue.get(i).matches("NOT|OR|AND"))
				tokenType.add("OPR");
			else if(tokenValue.get(i).matches("[a-zA-Z]+"))
				tokenType.add("LIT");
		}
		return;
	}

	public static void combine_tokens(LinkedList<String> tokenValue,StringBuffer statement) 
	{
		StringBuffer line=new StringBuffer();
		for(int i=0;i<tokenValue.size();i++)
			line.append(tokenValue.get(i)+" ");
		statement.delete(0,statement.length());
		statement.append(line);
		return;
	}

	public static void split_into_tokens(LinkedList<String> tokenValue, StringBuffer statement)
	{
		String data[]=new String[200];
		tokenValue.clear();
		data=statement.toString().split("[ \\t\\n\\r]+");
		for(int i=0;i<data.length;i++)
			tokenValue.add(data[i]);
		return;
	}


	public static int get_operand(LinkedList<String> tokenValue, int index, StringBuffer op)
	{
		int i,count;

		i=index;
		if(tokenValue.get(i).equals("("))
		{
			count=0;
			while(i<tokenValue.size())
			{
				op.append(tokenValue.get(i));
				if(tokenValue.get(i).equals("("))
				{
					count++;
				}
				if(tokenValue.get(i).equals(")"))
				{
					count--;
					if(count==0)
						break;
				}
				op.append(" ");
				i++;
			}
		}
		else
		{
			op.append(tokenValue.get(i));
		}
		return i;
	}

	public static void remove_double_implication(LinkedList<String> tokenValue,LinkedList<String> tokenType)
	{
		StringBuffer op1=new StringBuffer();
		StringBuffer op2=new StringBuffer();
		StringBuffer op3=new StringBuffer();
		StringBuffer op4=new StringBuffer();
		String data[]=new String[100];
		String result;
		int index,op1_end_index,op2_end_index,i;

		index=tokenValue.indexOf("<=>");
		op1_end_index=get_operand(tokenValue,index+1,op1);
		op2_end_index=get_operand(tokenValue,op1_end_index+1,op2);
		op3.append(op1);
		op4.append(op2);
		delete_tokens(tokenValue,tokenType,index,op2_end_index);
		op1.insert(0,"AND  ( => ");
		op2.append(" ) ( => "+op4+" "+op3+" )");
		result=new String(op1.toString()+" "+op2.toString());
		data=result.split("[ \\t\\n\\r]+");
		for(i=0;i<data.length;i++)
			tokenValue.add(index+i,data[i]);

		return;
	}

	public static void remove_implication(LinkedList<String> tokenValue,LinkedList<String> tokenType)
	{	
		StringBuffer op1=new StringBuffer();
		StringBuffer op2=new StringBuffer();
		String data[]=new String[200];
		String result;
		int index,op1_end_index,op2_end_index,i;

		index=tokenValue.indexOf("=>");
		op1_end_index=get_operand(tokenValue,index+1,op1);
		op2_end_index=get_operand(tokenValue,op1_end_index+1,op2);
		delete_tokens(tokenValue,tokenType,index,op2_end_index);
		op1.insert(0,"OR ( NOT ");
		op1.append(" )");
		result=new String(op1.toString()+" "+op2.toString());
		data=result.split("[ \\t\\n\\r]+");
		for(i=0;i<data.length;i++)
			tokenValue.add(index+i,data[i]);
		return;
	}


	public static void delete_tokens(LinkedList<String> tokenValue,LinkedList<String> tokenType,int start, int end) 
	{
		StringBuffer statement=new StringBuffer();
		combine_tokens(tokenValue, statement);
		int i=start;
		while(i<=end)
		{
			tokenValue.remove(i);
			end=end-1;
		}
		return;
	}


	public static void distribute_NOT(LinkedList<String> tokenValue, LinkedList<String> tokenType, int index)
	{
		StringBuffer op1=new StringBuffer();
		String current_token,first,second;
		LinkedList<String> op1_tokenValue=new LinkedList<String>();
		LinkedList<String> op1_tokenType=new LinkedList<String>();
		int op1_end_index,i=1;

		int op1_not_and_index,op2_not_and_index;
		StringBuffer op1_not_and=new StringBuffer();
		StringBuffer op2_not_and=new StringBuffer();

		int op1_not_or_index,op2_not_or_index;
		StringBuffer op1_not_or=new StringBuffer();
		StringBuffer op2_not_or=new StringBuffer();

		op1_end_index=get_operand(tokenValue,index+1,op1);
		delete_tokens(tokenValue, tokenType, index, op1_end_index);

		split_into_tokens(op1_tokenValue, op1);
		classify_tokens_based_on_type(op1_tokenValue, op1_tokenType);
		first=op1_tokenType.get(0);
		if(first.equals("("))
		{
			second=op1_tokenType.get(1);
			if(second.equals("OPR"))
			{
				i=1;
				current_token=op1_tokenValue.get(i);
				if(current_token.equals("NOT"))
				{
					op1_tokenValue.remove(i);
					op1_tokenType.remove(i);

					op1_tokenValue.remove(op1_tokenValue.size()-1);
					op1_tokenType.remove(op1_tokenType.size()-1);

					op1_tokenValue.remove(0);
					op1_tokenType.remove(0);
				}
				if(current_token.equals("AND"))
				{
					op1_tokenValue.remove(i);
					op1_tokenValue.add(i,"OR");
					StringBuffer and_operand=new StringBuffer();
		
					op1_not_and_index=get_operand(op1_tokenValue,i+1,op1_not_and);
					op1_not_and.insert(0, "( NOT ");
					op1_not_and.append(" )");

					op2_not_and_index=get_operand(op1_tokenValue,op1_not_and_index+1,op2_not_and);
					op2_not_and.insert(0, "( NOT ");
					op2_not_and.append(" )");

					and_operand.append(op1_not_and+" "+op2_not_and);
					LinkedList<String> tokens=new LinkedList<String>();
					delete_tokens(op1_tokenValue, op1_tokenType, i+1, op2_not_and_index);
					split_into_tokens(tokens, and_operand);
					for(int j=0;j<tokens.size();j++)
					{
						op1_tokenValue.add(i+1+j, tokens.get(j));
					}
				}

				if(current_token.equals("OR"))
				{
					StringBuffer or_operand=new StringBuffer();
					LinkedList<String> tokens=new LinkedList<String>();

					op1_tokenValue.remove(i);
					op1_tokenValue.add(i,"AND");

					op1_not_or_index=get_operand(op1_tokenValue,i+1,op1_not_or);
					op1_not_or.insert(0, "( NOT ");
					op1_not_or.append(" )");

					op2_not_or_index=get_operand(op1_tokenValue,op1_not_or_index+1,op2_not_or);
					op2_not_or.insert(0, "( NOT ");
					op2_not_or.append(" )");

					or_operand.append(op1_not_or+" "+op2_not_or);

					delete_tokens(op1_tokenValue, op1_tokenType, i+1, op2_not_or_index);
					split_into_tokens(tokens, or_operand);
					for(int j=0;j<tokens.size();j++)
					{
						op1_tokenValue.add(i+1+j, tokens.get(j));
					}
				}
				classify_tokens_based_on_type(op1_tokenValue, op1_tokenType);
				join_tokenlist(tokenValue,tokenType,op1_tokenValue,op1_tokenType,index); 
			}
		}

		op1_tokenType.clear();
		op1_tokenValue.clear();
		return ;
	}

	public static void join_tokenlist(LinkedList<String> tokenValue,LinkedList<String> tokenType, LinkedList<String> toadd_tokenValue,
			LinkedList<String> toadd_tokenType, int index) 
	{
		for(int i=0;i<toadd_tokenValue.size();i++)
		{
			tokenValue.add(index+i, toadd_tokenValue.get(i));
			tokenType.add(index+i, toadd_tokenType.get(i));
		}
		return;
	}


	public static StringBuffer distribute_OR(StringBuffer statement)
	{
		LinkedList<String> tokens=new LinkedList<String>();
		LinkedList<String> outer_op1_tokens=new LinkedList<String>();
		LinkedList<String> outer_op2_tokens=new LinkedList<String>();


		StringBuffer outer_op1=new StringBuffer();
		StringBuffer outer_op2=new StringBuffer();
		StringBuffer alpha=new StringBuffer();
		StringBuffer beta=new StringBuffer();
		StringBuffer gamma=new StringBuffer();
		StringBuffer result=new StringBuffer();
		StringBuffer op1_result=new StringBuffer();
		StringBuffer op2_result=new StringBuffer();


		StringBuffer outer_operator=new StringBuffer();
		StringBuffer inner_op1_operator=new StringBuffer();
		StringBuffer inner_op2_operator=new StringBuffer();
		int outer_op1_end_index=0,inner_op1_end_index=0;//inner_op2_end_index=0,outer_op2_end_index=0;

		split_into_tokens(tokens, statement);
		outer_operator.delete(0, outer_operator.length());
		outer_operator.append(get_operator(tokens,0));
		result.delete(0, result.length());
		result.append(statement);
		if(outer_operator.toString().equals("OR"))
		{
			if(tokens.contains("AND"))
			{
				outer_op1_end_index=get_operand(tokens, 2, outer_op1);
				get_operand(tokens, outer_op1_end_index+1, outer_op2);
				split_into_tokens(outer_op1_tokens,outer_op1);
				split_into_tokens(outer_op2_tokens,outer_op2);

				inner_op1_operator.delete(0, inner_op1_operator.length());
				inner_op1_operator.append(get_operator(outer_op1_tokens,0));

				inner_op2_operator.delete(0, inner_op2_operator.length());
				inner_op2_operator.append(get_operator(outer_op2_tokens,0));
	
				if(inner_op1_operator.toString().equals("AND"))
				{
					beta.delete(0, beta.length());
					gamma.delete(0, gamma.length());
					alpha.delete(0, alpha.length());
					result.delete(0, result.length());
					inner_op1_end_index=get_operand(outer_op1_tokens, 2, beta);
					get_operand(outer_op1_tokens, inner_op1_end_index+1, gamma);
					alpha.append(outer_op2);
					result.append("( AND ( OR "+beta+" "+alpha+" ) ( OR "+gamma+" "+alpha+" ) )");
				}
				else if(inner_op2_operator.toString().equals("AND"))
				{
					beta.delete(0, beta.length());
					gamma.delete(0, gamma.length());
					alpha.delete(0, alpha.length());
					result.delete(0, result.length());
					inner_op1_end_index=get_operand(outer_op2_tokens, 2, beta);
					get_operand(outer_op2_tokens, inner_op1_end_index+1, gamma);
					alpha.append(outer_op1);
					result.append("( AND ( OR "+alpha+" "+beta+" ) ( OR "+alpha+" "+gamma+" ) )");
				}
				else
				{
					op1_result.delete(0, op1_result.length());
					op2_result.delete(0, op2_result.length());

					op1_result.append(distribute_OR(outer_op1));
					op2_result.append(distribute_OR(outer_op2));
	
					result.delete(0, result.length());
					result.append("( "+outer_operator+" "+op1_result+" "+op2_result+" )");
				}
			}
		}
		tokens.clear();
		outer_op1_tokens.clear();
		outer_op2_tokens.clear();
		return result;
	}

	public static String get_operator(LinkedList<String> tokens, int index)
	{
		StringBuffer result=new StringBuffer();
		for(int i=index;i<tokens.size();i++)
		{
			if(tokens.get(i).equals("NOT"))
			{
				result.append("NOT");
				break;
			}
			else if(tokens.get(i).equals("AND"))
			{
				result.append("AND");
				break;
			}
			else if(tokens.get(i).equals("OR"))
			{
				result.append("OR");
				break;
			}

		}
		return result.toString();
	}
	
}
