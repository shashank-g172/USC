import java.util.EmptyStackException;
import java.util.Stack;
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
import java.util.Stack;
import java.util.StringTokenizer;
import java.util.regex.Matcher;
import java.util.regex.Pattern;


public class Program {
		private static java.util.LinkedList<String> res = new java.util.LinkedList<String>();
		private static java.util.LinkedList<String> res1 = new java.util.LinkedList<String>();
		private static java.util.LinkedList<String> eval = new java.util.LinkedList<String>();
		private static java.util.LinkedList<String> stk = new java.util.LinkedList<String>();
		private static java.util.LinkedList<String> notty = new java.util.LinkedList<String>();
	
		public int bracketsCount =0;
	
		
		private static void popify(String s)
		{
			for (int i = 0;i < s.length();i++)
			{
				int j = 1;
				int k = i;
				if (s.charAt(i) == ' ')
					continue;
				if (s.charAt(i) == '(' || s.charAt(i) == ')')
				{
					eval.offer(s.substring(i, i + 1));
					continue;
				}
				while (s.charAt(k) != ' ' && s.charAt(k) != '\n' && s.charAt(k) != '(' && s.charAt(k) != ')')
				{
					k++;
					j++;
				}
				eval.offer(s.substring(i, i + j - 1));
				i = i + j - 2;
			}
		}
		
		public static void main(String[] args) {
		String inp = "(OR (OR tv party) (study))(=> exam (NOT (OR tv party)))(=> study pass)((OR (AND pass (NOT reject)) (AND (NOT pass) reject)))(AND (OR (NOT study) pass) (=> pass study))(=> pass (OR (AND goodgrade (NOT badgrade)) (AND badgrade (NOT goodgrade))))(OR (NOT goodgrade) award)(=> (NOT (award))(badgrade))(OR (OR (NOT study) (NOT smart)) goodgrade)(NOT (NOT exam))((smart))";
		int bracketsCount = 0;
		int k = 0;
		for (int i = 0;i < inp.length();i++)
		{
			if (inp.charAt(i) == '(')
			{
				if (bracketsCount == 0)
				{
					k = i;
				}
				bracketsCount++;
				continue;
			}

			if (inp.charAt(i) == ')')
			{
				bracketsCount--;
				if (bracketsCount == 0)
				{
					res1.offer(inp.substring(k, i + 1));
				}
				continue;
			}
		}

		while (!res1.isEmpty())
		{
			res.offer(res1.peek());
			System.out.print(res1.peek());
			System.out.print("\n");
			res1.poll();


		}
		System.out.print("===============");
		System.out.print("\n");

		String nw = "";
		while (!res.isEmpty())
		{
			String s = res.peek();
			res.poll();
			popify(s);

			String str = "";
			while (!eval.isEmpty())
			{
				str = eval.peek();
				eval.poll();

				if (!str.equals("=>"))
				{
					nw+=(str);
					nw+=(" ");
				}
				else
				{
					nw+=("NOT ");
					nw+=(eval.peek());
					eval.poll();
					nw+=(" OR ");
				}
			}
			stk.offer(nw);
			nw = "";
		}

		/*while (!stk.isEmpty())
		{
			String s = res.peek();
			stk.poll();
			popify(s);
			String str = "";
			while (!eval.isEmpty())
			{
				str = eval.peek();
				eval.poll();
				if (!str.equals("NOT"))
				{
					nw+=(str);
					nw+=(" ");
				}
				else
				{
					if (!eval.peek().equals("("))
					{
						nw+=("NOT ");
						nw+=(eval.peek());
						nw+=(" ");
						continue;
					}
					else if (eval.peek().equals("OR"))
					{
						nw+=(" AND ");
						
						if (eval.peek().equals("("))
						{
							nw+=(eval.peek());
							nw+=(" ");
							eval.poll();
							bracketsCount++;
						}
						else
						{
							nw+=(eval.peek());
							nw+=(" ");
							eval.poll();
						}

						while (bracketsCount != 0)
						{
							if (eval.peek().equals("("))
							{
								bracketsCount++;
							}

							if (eval.peek().equals(")"))
							{
								bracketsCount--;
							}
							nw+=(eval.peek());
							nw+=(" ");
							eval.poll();
						}
						nw+=("NOT ");
						if (eval.peek().equals("("))
						{
							nw+=(eval.peek());
							nw+=(" ");
							eval.poll();
							bracketsCount++;
						}
						else
						{
							nw+=(eval.peek());
							nw+=(" ");
							eval.poll();
						}

						while (bracketsCount != 0)
						{
							if (eval.peek().equals("("))
							{
								bracketsCount++;
							}

							if (eval.peek().equals(")"))
							{
								bracketsCount--;
							}
							nw+=(eval.peek());
							nw+=(" ");
							eval.poll();
						}

					}
				}
			}

			notty.offer(nw);
			nw = "";
		}
		*/
		while (!stk.isEmpty())
		{
			System.out.print(stk.peek());
			System.out.print("\n");
			stk.poll();
		}
	}
}

