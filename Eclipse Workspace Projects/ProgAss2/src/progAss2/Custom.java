package progAss2;

public class Custom {

	private String operator;
	public String getOperator() {
		return operator;
	}
	public void setOperator(String operator) {
		this.operator = operator;
	}
	private Custom leftChild;
	public Custom getRightChild() {
		return rightChild;
	}
	public void setRightChild(Custom rightChild) {
		this.rightChild = rightChild;
	}
	public String getOnlyOperand() {
		return onlyOperand;
	}
	public void setOnlyOperand(String onlyOperand) {
		this.onlyOperand = onlyOperand;
	}
	public Custom getLeftChild() {
		return leftChild;
	}
	public void setLeftChild(Custom leftChild) {
		this.leftChild = leftChild;
	}
	private Custom rightChild;
	
	private String onlyOperand;
}
