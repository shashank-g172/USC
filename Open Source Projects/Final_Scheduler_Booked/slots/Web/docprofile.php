<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Fetchingly 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20130903

-->

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="styles.css" rel="stylesheet" type="text/css" media="all" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Doctor Profile</title>
<meta name="keywords" content="" />
<meta name="description" content="" />

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" rel="stylesheet" />
<link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />


<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>


  

<?php 

define('ROOT_DIR', '../');
include('connection.php');
require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'lib/Config/namespace.php');
require_once(ROOT_DIR . 'lib/Common/namespace.php');
require_once(ROOT_DIR . 'lib/Application/Attributes/namespace.php');
require_once(ROOT_DIR . 'Pages/ProfilePage.php');


$page =  new ProfilePage();
$page->Display('globalheader.tpl');
    
    if (!isset($_GET['uid'])) {$uid=""; }
    else {$uid=$_GET['uid']; }
    
    if ($uid==null and $uid=="")
    {
     	echo "Incorrect page redirect. Please use the back button to go the previous page"; 
    }

$query = "SELECT * from docprofile where user_id = '$uid'";
$result1 = mysql_query($query,$bd);     

if(!$result1)
{
  die;
}
if ($result1) {
  while ($row = mysql_fetch_array($result1)) {
    
    $username = $row['duser_name'];
    $fn = $row['doctor_fname'];
    $ln = $row['doctor_lname'];
    $PNo = $row['phone_no'];
    $email = $row['email'];
    $gender = $row['gender'];
    $lno = $row['license_no'];
    $Edate = $row['expirydate'];
    $spec_data = $row['spec_data'];
    $personal_desc = $row['personal_desc'];
    $image1=$row['certificate1'];
    $image2=$row['certificate2'];
    $image3=$row['certificate3'];
  }
}   
    
 $today = date('Y-m-d');   
   
echo <<<EOT
<div id="carbonForm">
<form name="reg">
  
  <div> 
  <div class="formRow">
            <div class="label">
                <label for="Uname">Username:</label>
            </div>
            
            <div class="field">
                <label> $username </label>
            </div>
    </div>  
  
  
    
  
  
  
  
  <div class="formRow">
            <div class="label">
                <label for="Fname">FirstName:</label>
            </div>
            
            <div class="field">
                <label>$fn</label>
            </div>
    </div>  
  
  
    
  <div class="formRow">
            <div class="label">
                <label for="Lname">LastName:</label>
            </div>
            
            <div class="field">
                <label>$ln</label>
            </div>
    </div>  
  
  <div class="formRow">
            <div class="label">
                <label for="email">Email:</label>
            </div>
            
            <div class="field">
                <label>$email</label>
            </div>
    </div>  
    
  <div class="formRow">
            <div class="label">
                <label for="PNo">Phone:</label>
            </div>
            
            <div class="field">
                <label>$PNo</label>
            </div>
     </div>

   <div class="formRow">
            <div class="label">
                <label for="LNum">License#:</label>
            </div>
            
            <div class="field">
                <label>$lno</label>
            </div>
    </div>  
  
    
  <div class="formRow">
            <div class="label">
                <label for="EDate">ExpiryDate:</label>
            </div>
            
            <div class="field">
                <label>$Edate</label>
            </div>
    </div>  
    
  <div class="formRow">
            <div class="label">
                <label for="spec">Specialization:</label>
            </div>
            
            <div class="field">
                <label>$spec_data</label>
            </div>
    </div>  
    
  <div class="formRow">
            <div class="label">
                <label for="desc">Description:</label>
            </div>
            
            <div class="field">
                <label>$personal_desc</label>  <br/><br/>
            </div>
    </div>  

    </div>
  
<br/><br/>


<div class="zoom_img_1">
  <img src="certificates/$image1" >
 </div>

<div class="zoom_img_2">
  <img src="certificates/$image2" onerror="this.src=''">
 </div>

 <div class="zoom_img_3">
  <img src="certificates/$image3" onerror="this.src=''">
 </div>




  <br/><br/><br/><br/>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
  
  </form>
</div>
<br><br>        
EOT;
?>
                
<div class="img">
<img  src="img/footer.jpg" width='100%' />
</div>      


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>

</body>
</html>
