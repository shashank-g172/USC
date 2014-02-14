import java.util.LinkedList;


public class Clause {

	LinkedList<String> sentences = new LinkedList<String>();
	String literals;
	
	
	public String getLiterals() {
		return literals;
	}

	public void setLiterals(String literals) {
		this.literals = literals;
	}

	public LinkedList<String> getsentences() {
		return sentences;
	}

	public void setsentences(LinkedList<String> literals) {
		this.sentences = sentences;
	}

	

public String inNegation(String literal)
{
	return ("NOT"+literal);
}
	

}
