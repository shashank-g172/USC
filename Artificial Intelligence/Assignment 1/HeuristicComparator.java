import java.util.Comparator;


public class HeuristicComparator implements Comparator<Grid> {

	@Override
	public int compare(Grid arg0, Grid arg1) {
		return arg0.getTotalHeuristic() < arg1.getTotalHeuristic()? -1 : arg0.getTotalHeuristic()== arg1.getTotalHeuristic() ? 0 : 1;
	}

}
