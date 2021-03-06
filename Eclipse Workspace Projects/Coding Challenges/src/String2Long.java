public class String2Long {

	public final static long StringToLong(CharSequence d) {
	    int l = d.length();
	    boolean n= d.charAt(0) == '-';
	    long v = 0;
	    int p = n?1:0;
	    do {
	        v *= 10;
	        int i = d.charAt(p) - 48;
	        if (i < 0 | i > 9)
	            throw new NumberFormatException(d+"");
	        v += i;
	        p++;
	    } while (l > p);
	    return n?-v:v ;
	}
	public static void main(String[] args) {
		String s = "123";
	    long i = StringToLong(s);
	    if(i==123)
	    	System.out.println("Success!");
	    else
	    	System.out.println("Failure");
	    System.out.println("String "+s+" in long is "+i);

	}

}
