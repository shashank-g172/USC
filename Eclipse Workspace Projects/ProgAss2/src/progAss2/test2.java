package progAss2;

import java.util.Stack;

public class test2 {

	Custom custom = new Custom();
	private static Stack<Custom> stack = new Stack<Custom>();
	private static String OR = "OR";
	private static String AND = "AND";
	private static String DIMP = "<=>";
	private static String IMP = "=>";
	private static String NOT = "NOT";

	public static void Resolve(String sNiceString) {
		sNiceString = sNiceString.replaceAll("\\(", " ");
		sNiceString = sNiceString.replaceAll("\\)", " ");
		// System.out.println(sNiceString);

		String[] tokens = sNiceString.split(" ");

		for (int i = tokens.length - 1; i > 0; i--) {
			String operand = tokens[i];
			if (!operand.equals(OR) && !operand.equals(AND)
					&& !operand.equals(DIMP) && !operand.equals(IMP)
					&& !operand.equals(NOT)) {
				Custom test = new Custom();
				test.setOnlyOperand(tokens[i]);
				stack.push(test);

			} else if (operand.equals(OR)) {
				Custom testOR = new Custom();
				testOR.setOperator(operand);
				testOR.setLeftChild(stack.pop());
				testOR.setRightChild(stack.pop());
				stack.push(testOR);
			}
			if (operand.equals(AND)) {
				Custom testAND = new Custom();
				testAND.setOperator(operand);
				testAND.setLeftChild(stack.pop());
				testAND.setRightChild(stack.pop());
				stack.push(testAND);
			}
			if (operand.equals(NOT)) {
				Custom testNOT = new Custom();
				testNOT.setOperator(operand);
				testNOT.setLeftChild(stack.pop());

				stack.push(testNOT);
			}
			if (operand.equals(IMP)) {
				Custom testIMP = new Custom();
				testIMP.setOperator(operand);
				testIMP.setLeftChild(stack.pop());
				testIMP.setRightChild(stack.pop());
				stack.push(testIMP);
			}
			if (operand.equals(DIMP)) {
				Custom testDIMP = new Custom();
				testDIMP.setOperator(operand);
				testDIMP.setLeftChild(stack.pop());
				testDIMP.setRightChild(stack.pop());
				stack.push(testDIMP);
			}
		}

	}

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		String test = "(OR (OR tv party) (study))";
		Resolve(test);
		System.out.println("Here");
	}

}
