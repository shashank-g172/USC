
public class Grid {

	int x,y;
	char c;

	private Grid north;
	private Grid south;
	private Grid east;
	private Grid west;
	private Grid parentNode;
	float manDistance;
	private boolean isVisited;
	float totalHeuristic;
	float totalLen;
	int beamValue;
	
	public int getBeamValue() {
		return beamValue;
	}
	public void setBeamValue(int beamValue) {
		this.beamValue = beamValue;
	}
	float speed;
	float mudCount;
	
	public float getMudCount() {
		return mudCount;
	}
	public void setMudCount(float mudCount) {
		this.mudCount = mudCount;
	}
	public float getGvalue() {
		return gvalue;
	}
	public void setGvalue(float gvalue) {
		this.gvalue = gvalue;
	}
	float gvalue;
	
	public float getSpeed() {
		return speed;
	}
	public void setSpeed(float speed) {
		this.speed = speed;
	}
	public Grid(int x, int y,char c, Grid parentNode, float Mandist) {
		this.x = x; 
		this.y = y;
		this.c=c;
		this.setParentNode(parentNode);
		this.manDistance = Mandist;
	}
	public float getTotalHeuristic() {
		return totalHeuristic;
	}

	
	public void setTotalHeuristic(float totalHeuristic) {
		this.totalHeuristic = totalHeuristic;
	}

	
	public Grid(int x, int y,char c) {
		this(x,y,c,null,0);
	}
	
	public String toString() {
		// TODO Auto-generated method stub
		return "x:" + x + "," + "y:" + y + "c:" + String.valueOf(c) + "f(n):" +totalHeuristic;
	}

	public int getX() {
		return x;
	}

	public void setX(int x) {
		this.x = x;
	}

	public int getY() {
		return y;
	}

	public void setY(int y) {
		this.y = y;
	}

	public char getC() {
		return c;
	}

	public void setC(char c) {
		this.c = c;
	}

	public Grid(){

	}

	public Grid goNorth()
	{
		return north;
	}

	public Grid goSouth()
	{
		return south;
	}
	public Grid goEast()
	{
		return east;
	}
	public Grid goWest()
	{
		return west;
	}

	public void setNorth(Grid north) {
		this.north = north;
	}

	public void setSouth(Grid south) {
		this.south = south;
	}

	public void setEast(Grid east) {
		this.east = east;
	}

	public void setWest(Grid west) {
		this.west = west;
	}

	public void setParentNode(Grid parentNode) {
		this.parentNode = parentNode;
	}

	public Grid getParentNode() {
		return parentNode;
	}

	public void setVisited(boolean isVisited) {
		this.isVisited = isVisited;
	}

	public boolean isVisited() {
		return isVisited;
	}

	public void ManDist(float Mandist) {
		this.manDistance = Mandist;
	}

	public float getManDist() {
		return manDistance;
	}
	public float getTotalLen() {
		return totalLen;
	}
	public void setTotalLen(float totalLen) {
		this.totalLen = totalLen;
	}
}

