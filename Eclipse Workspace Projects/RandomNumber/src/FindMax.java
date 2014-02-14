import java.util.Random;


public class FindMax {

	public static int maxOfArray(int[] a) {
	    int max = a[0];
	    for (int i : a)
	        if (max < i)
	            max = i;
	    return max;
	}

	public static int findMaxTheHardWay(int[] array) {
	    for (int length = array.length; length > 1; length = (length + 1) / 2) {
	        for (int i = 0; i < length / 2; i++) {
	            if (array[i] < array[length - i - 1])
	                array[i] = array[length - i - 1]; // don't need to swap.
	        }
	    }
	    return array[0];
	}

	public static void main(String... args) {
	    Random rand = new Random(1);
	    for (int i = 1; i <= 1000; i++) {
	        int[] a = new int[i];
	        for (int j = 0; j < i; j++) a[j] = rand.nextInt();
	        int max = maxOfArray(a);
	        int max2 = findMaxTheHardWay(a);
	        if (max != max2)
	            throw new AssertionError(i + ": " + max + " != " + max2);
	    }
	}

}
