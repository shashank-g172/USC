import java.util.EmptyStackException;
import java.util.Stack;


public class Test{

	public static void main(String[] args) throws EmptyStackException

{
	Stack<String> stk = new Stack<String>();
	Stack<String> eval = new Stack<String>();
	Stack<String> res = new Stack<String>();
	String inp = "(OR (OR tv party) (study))(=> exam (NOT (OR tv party)))(=> study pass)((OR (AND pass (NOT reject)) (AND (NOT pass) reject)))(AND (OR (NOT study) pass) (=> pass study))(=> pass (OR (AND goodgrade (NOT badgrade)) (AND badgrade (NOT goodgrade))))(OR (NOT goodgrade) award)(=> (NOT (award))(badgrade))(OR (OR (NOT study) (NOT smart)) goodgrade)(NOT (NOT exam))((smart))";

	for (int i = 0;i < inp.length();i++)
	{
		int j = 1;
		int k = i;
		if (inp.charAt(i) == ' ')
			continue;
		if (inp.charAt(i) == '(' || inp.charAt(i) == ')')
		{
			stk.push(inp.substring(i, i + 1));
			continue;
		}
		while (inp.charAt(k) != ' ' && inp.charAt(k) != '\n' && inp.charAt(k) != '(' && inp.charAt(k) != ')')
		{
			k++;
			j++;
		}
		stk.push(inp.substring(i, i + j - 1));
		i = i + j - 2;

	}

	while (!stk.empty())
	{
		String s = stk.peek();
		stk.pop();

		if (s.equals("("))
		{
			String nw = "( ";
			while (!stk.empty())
			{
				String start = stk.peek();
				stk.pop();

				if (start.equals("("))
				{
					//String nw = "( ";
					while (!(eval.peek().equals(")")))
					{
						nw+=(eval.peek());
						nw+=(" ");
						eval.pop();
					}
					nw+=(")");
					eval.pop();
					eval.push(nw);
					continue;
				}
				else if (s.equals("OR"))
				{
					String s1 = eval.peek();
					eval.pop();
					String s2 = eval.peek();
					eval.pop();
					String s3 = s1;
					s3+=(" ");
					s3+=("OR");
					s3+=(" ");
					s3+=(s2);
					eval.push(s3);
					continue;
				}
				else if (s.equals("=>"))
				{
					String s1 = eval.peek();
					eval.pop();
					String s2 = eval.peek();
					eval.pop();
					String s3 = "NOT ";
					s3+=(s1);
					s3+=(" ");
					s3+=("OR");
					s3+=(" ");
					s3+=(s2);
					eval.push(s3);
					continue;
				}
				else if (s.equals("AND"))
				{
					String s1 = eval.peek();
					eval.pop();
					String s2 = eval.peek();
					eval.pop();
					String s3 = s1;
					s3+=(" ");
					s3+=("AND");
					s3+=(" ");
					s3+=(s2);
					eval.push(s3);
					continue;
				}
				else if (s.equals("NOT"))
				{
					String s1 = eval.peek();
					eval.pop();
					String s3 = "";
					s3+=("NOT");
					s3+=(" ");
					s3+=(s1);
					eval.push(s3);
					continue;
				}

			eval.push(s);

	}

	while (!eval.empty())
	{
	System.out.print(eval.peek());
	System.out.print("\n");
	eval.pop();
	}



	//while(!stk.empty())
	
	//	cout<<stk.top()<<endl;
	//	stk.pop();
	
} 
	}
	
}
}

