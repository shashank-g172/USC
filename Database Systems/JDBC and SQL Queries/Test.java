import java.sql.*;
import java.io.*;
import java.util.StringTokenizer;

public class Test {
        static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";  

        //  Database credentials
        static String HOST;
        static String PORT;
        static String DB;
        static String DB_URL;
        static String USER;
        static String PASS;
        public static void main(String[] args) {
        
        //Connection conn = null;
        //Statement stmt = null;
        try{
            FileInputStream fstream = new FileInputStream(args[0]);
            DataInputStream in = new DataInputStream(fstream);
            BufferedReader br = new BufferedReader(new InputStreamReader(in));
            String strLine;

            int i=0;
            while((strLine=br.readLine())!=null){
                i++;
                if(i==1)
                    HOST=strLine;
                else if (i==2)
                    PORT=strLine;
                else if(i==3)
                    DB=strLine;
                else if(i==4)
                    USER=strLine;
                else if(i==5)
                    PASS=strLine;
            }

            in.close();
            DB_URL = "jdbc:mysql://"+HOST+":"+PORT+"/"+DB;
        
        }catch (Exception e){
            System.err.println("Error: " + e.getMessage());
        }
        Connection conn = null;
        Statement stmt = null;
        PreparedStatement pst = null;
        ResultSet rs = null;
        try{
            
            Class.forName("com.mysql.jdbc.Driver");
            conn = DriverManager.getConnection(DB_URL, USER, PASS);
            
                String sql = "delete from Partners;";
                pst = conn.prepareStatement(sql);
                pst.executeUpdate();
                pst.close();
            
                sql = "delete from Views;";
                pst = conn.prepareStatement(sql);
                pst.executeUpdate();
                pst.close();
            
                sql = "delete from Ad_Target_Categories;";
                pst = conn.prepareStatement(sql);
                pst.executeUpdate();
                pst.close();
            
                sql = "delete from Advertisements;";
                pst = conn.prepareStatement(sql);
                pst.executeUpdate();
                pst.close();
            
                sql = "delete from Videos;";
                pst = conn.prepareStatement(sql);
                pst.executeUpdate();
                pst.close();
            
                sql = "delete from Users;";
                pst = conn.prepareStatement(sql);
                pst.executeUpdate();
                pst.close();
            
            
                    FileInputStream fstream1 = new FileInputStream(args[1]);
                    DataInputStream in1 = new DataInputStream(fstream1);
                    BufferedReader br1 = new BufferedReader(new InputStreamReader(in1));
                    String strLine1;
            
                    
                    sql =
                          "insert into Users values(?,?,?,?,?);";
                    pst = conn.prepareStatement(sql);
                    while((strLine1=br1.readLine())!=null){
                        StringTokenizer st = new StringTokenizer(strLine1, ",");
                        while(st.hasMoreTokens()) 
                        { 
                            String uname = st.nextToken();
                            String uname_m = uname.substring(1, uname.length()-1);
                            String pwd = st.nextToken(); 
                            String pwd_m = pwd.substring(1, pwd.length()-1);
                            String nme = st.nextToken();
                            String nme_m = nme.substring(1, nme.length()-1);
                            String mail = st.nextToken();
                            String mail_m = mail.substring(1, mail.length()-1);
                            String dreg = st.nextToken();
                            String dreg_m = dreg.substring(1, dreg.length()-1);
                            
                            pst.setString(1, uname_m);
                            pst.setString(2, pwd_m);
                            pst.setString(3,nme_m);
                            pst.setString(4, mail_m);
                            pst.setString(5, dreg_m);
                            pst.executeUpdate();
                        }
                    }
                    pst.close();
                    
                    //for Videos Table
                    fstream1 = new FileInputStream(args[2]);
                    in1 = new DataInputStream(fstream1);
                    br1 = new BufferedReader(new InputStreamReader(in1));                    
                    sql = "insert into Videos values(?,?,?,?,?);";
                    pst = conn.prepareStatement(sql);
                    while((strLine1=br1.readLine())!=null){
                    String[] tokens = strLine1.split(",(?=([^\"]*\"[^\"]*\")*[^\"]*$)");
                    int i=0;
                    String uname_m=new String();
                    String pwd_m= new String();
                    String nme_m=new String();
                    String mail_m=new String();
                    String dreg_m=new String();     
                    for(String t : tokens) {
                             if(i==0)
                                 uname_m = t.substring(1, t.length()-1);
                             else if(i==1)
                                pwd_m = t.substring(1, t.length()-1);
                             else if(i==2)
                                nme_m = t.substring(1, t.length()-1);
                             else if(i==3)
                                mail_m = t.substring(1, t.length()-1);
                             else if(i==4)
                                dreg_m = t.substring(1, t.length()-1);
                             i++;
                         }
                             pst.setString(1, uname_m); 
                             pst.setString(2, pwd_m);
                             pst.setString(3,nme_m);
                             pst.setString(4, mail_m);
                             pst.setString(5, dreg_m);
                             
                             pst.executeUpdate();
                         
                     }

                    //for Advertisements table
                    fstream1 = new FileInputStream(args[3]);
                    in1 = new DataInputStream(fstream1);
                    br1 = new BufferedReader(new InputStreamReader(in1));
                    
                    sql = "insert into Advertisements values(?,?,?,?);";
                    pst = conn.prepareStatement(sql);
                                                                                                            while((strLine1=br1.readLine())!=null){
                        StringTokenizer st = new StringTokenizer(strLine1, ",");
                        while(st.hasMoreTokens())
                        {
                            String uname = st.nextToken();
                            String uname_m = uname.substring(1, uname.length()-1);
                            String pwd = st.nextToken();
                            String pwd_m = pwd.substring(1, pwd.length()-1);
                            String mail = st.nextToken();
                            Float mail_m = Float.parseFloat(mail);
                            String nme = st.nextToken();
                            Integer nme_m = Integer.parseInt(nme);
                            
                            pst.setString(1, uname_m);
                            pst.setString(2, pwd_m);
                            pst.setInt(4,nme_m);
                            pst.setFloat(3, mail_m);
                            pst.executeUpdate();
                        }
                                                                                                            }
                pst.close();
                
                //for Ad_Target_Categories table
                fstream1 = new FileInputStream(args[4]);
                in1 = new DataInputStream(fstream1);
                br1 = new BufferedReader(new InputStreamReader(in1));
                sql = "insert into Ad_Target_Categories values(?,?);";
                pst = conn.prepareStatement(sql);
                while((strLine1=br1.readLine())!=null){
                    StringTokenizer st = new StringTokenizer(strLine1, ",");
                    while(st.hasMoreTokens())
                    {
                        String uname = st.nextToken();
                        String uname_m = uname.substring(1, uname.length()-1);
                        String pwd = st.nextToken();
                        String pwd_m = pwd.substring(1, pwd.length()-1);
                        
                        pst.setString(1, uname_m);
                        pst.setString(2, pwd_m);
                        pst.executeUpdate();
                    }
                }
                pst.close();
              
                //for Views tables
                fstream1 = new FileInputStream(args[5]);
                in1 = new DataInputStream(fstream1);
                br1 = new BufferedReader(new InputStreamReader(in1));
                        
                sql = "insert into Views values(?,?,?,?,?,?);";
                pst = conn.prepareStatement(sql);
                while((strLine1=br1.readLine())!=null){
                    String str[]=strLine1.split(",");
                    String uname = str[0];
                    String uname_m = uname.substring(1, uname.length()-1);
                    String pwd = str[1];
                    String pwd_m = pwd.substring(1, pwd.length()-1);
                    String viwd = str[2];
                    String viw_m = viwd.substring(1, viwd.length()-1);
                    
                    if(str.length==6)
                        {
                            for(int i=0;i<6;i++)
                            {
                                if(("").equals(str[i]))
                                    str[i]="NULL";
                            }
                        
                        String mail= str[3];
                        if(("NULL").equals(str[3]))
                            pst.setString(4,null);
                        else
                        {
                            Integer mail_m = Integer.parseInt(mail);
                            pst.setInt(4,mail_m);
                        }
                            
                        String ads = str[4];  
                        if(("NULL").equals(str[4]))
                            pst.setString(5,null);
                        else
                        {
                            String ads_m = ads.substring(1, ads.length()-1);
                            pst.setString(5, ads_m);
                        }
                        
                        String nme = str[5];
                        if(("NULL").equals(str[5]))                                                     pst.setString(6,null);
                        else
                        {
                            Integer nme_m = Integer.parseInt(nme);
                            pst.setInt(6,nme_m);
                        } 
                        }
                    else if(str.length==4)
                    {
                        String mail= str[3];
                        Integer mail_m = Integer.parseInt(mail);
                        pst.setInt(4,mail_m);
                        pst.setString(5,null);
                        pst.setString(6,null);
                    }
                    else if(str.length==3)
                    {
                        pst.setString(4,null);
                        pst.setString(5,null);
                        pst.setString(6,null);
                    }
                    else if(str.length==5)
                    {
                        String mail= str[3];
                        Integer mail_m = Integer.parseInt(mail);
                        pst.setInt(4,mail_m);
                        
                        String ads = str[4];
                        String ads_m = ads.substring(1, ads.length()-1);
                        pst.setString(5, ads_m);
                        pst.setString(6,null);
                    }
                        pst.setString(1, uname_m);
                        pst.setString(2, pwd_m);
                        pst.setString(3, viw_m);
                        pst.executeUpdate();
                    
                }
                pst.close();
                
                //for Partners tables
                fstream1 = new FileInputStream(args[6]);
                in1 = new DataInputStream(fstream1);
                br1 = new BufferedReader(new InputStreamReader(in1));
                sql = "insert into Partners values(?,?);";
                pst = conn.prepareStatement(sql);
            
            while((strLine1=br1.readLine())!=null){
                StringTokenizer st = new StringTokenizer(strLine1, ",");
                while(st.hasMoreTokens())
                {
                    String uname = st.nextToken();
                    String uname_m = uname.substring(1, uname.length()-1);
                    String pwd = st.nextToken();
                    Float pwd_m = Float.parseFloat(pwd);
                                                                                                pst.setString(1, uname_m);
                    pst.setFloat(2, pwd_m);
                    pst.executeUpdate();
                }
                                                                                            }
                pst.close();
        }catch(SQLException se){
            
        }catch(Exception e){
            e.printStackTrace();
        }finally{
            try{
                if(stmt!=null)
                    conn.close();
            }catch(SQLException se){
            }
            try{
                if(conn!=null)
                    conn.close();
            }catch(SQLException se){
                se.printStackTrace();
            }
        }
        }
}
