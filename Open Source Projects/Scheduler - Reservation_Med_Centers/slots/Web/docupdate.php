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
<script type="text/javascript">


function validateForm()
{
var a=document.forms["reg"]["Uname"].value;
var b=document.forms["reg"]["password"].value;
var c=document.forms["reg"]["Fname"].value;
var d=document.forms["reg"]["Lname"].value;
var e=document.forms["reg"]["email"].value;
var f=document.forms["reg"]["PNo"].value;
var g=document.forms["reg"]["gender"].value;
var h=document.forms["reg"]["LNum"].value;
var i=document.forms["reg"]["EDate"].value;
var j=document.forms["reg"]["spec"].value;
var k=document.forms["reg"]["desc"].value;

var re = /\S+@\S+\.\S+/;
var eTest = re.test(e);



if ((a==null || a=="") && (b==null || b=="") && (c==null || c=="") && (d==null || d=="") && (e==null || e=="") && (f==null || f=="") && (h==null || h=="") && (i==null || i=="") && (j==null || j=="") )
  {
  alert("All Field must be filled out");
  return false;
  }

  if ( eTest=="false")
  {
  alert("Invlaid email ID format");
  return false;
  }
  
  if (a==null || a=="")
  {
  alert("User name must be filled out");
  return false;
  }
if (b==null || b=="")
  {
  alert("Password name must be filled out");
  return false;
  }
if (c==null || c=="")
  {
  alert("First name must be filled out");
  return false;
  }
if (d==null || d=="")
  {
  alert("Last name  must be filled out");
  return false;
  }
if (e==null || e=="")
  {
  alert("Email  must be filled out");
  return false;
  }
if (f==null || f=="")
  {
  alert("Phone Number must be filled out");
  return false;
  }

if (h==null || h=="")
  {
  alert("License Number must be filled out");
  return false;
  }
  
if (i==null || i=="")
  {
  alert("Expiry Date must be filled out");
  return false;
  }

if (j==null || j=="")
  {
  alert("Specialization must be filled out");
  return false;
  }  


}
</script>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit your Profile</title>
<meta name="keywords" content="" />
<meta name="description" content="" />

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" rel="stylesheet" />
<link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />


<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>


	

<div class="img">
<img  src="img/header.jpg" width='100%' />
</div>

<?php 

define('ROOT_DIR', '../');
include('connection.php');
require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'lib/Config/namespace.php');
require_once(ROOT_DIR . 'lib/Common/namespace.php');
require_once(ROOT_DIR . 'lib/Application/Attributes/namespace.php');



	  /*  header('Content-Type: image/jpg');
		readfile('C:\wamp\www\slots\Web\img\header.jpg');*/
		
		
		
		if (!isset($_GET['remarks'])) {$remarks=""; }
		else {$remarks=$_GET['remarks']; }
		
		if ($remarks==null and $remarks=="")
		{
		  
		}
		if ($remarks=='success')
		{
		echo 'Registration Successful. Continue to login';
		}
		if ($remarks=='dup')
		{
		echo '<p align="center"><b>Username Duplicate. Retry</b></p>';
		}

$userSession = ServiceLocator::GetServer()->GetUserSession();
$uid = $userSession->UserId;
		
$query = "SELECT * from docprofile where user_id = '$uid'";
$result1 = mysql_query($query,$bd);			

if(!$result1)
{
	die;
}
if ($result1) {
	while ($row = mysql_fetch_array($result1)) {
		
		$username = $row['duser_name'];
		//$password = $row['duser_name'];
		$fn = $row['doctor_fname'];
		$ln = $row['doctor_lname'];
		$PNo = $row['phone_no'];
		$email = $row['email'];
		$gender = $row['gender'];
		$lno = $row['license_no'];
		$Edate = $row['expirydate'];
		$spec_data = $row['spec_data'];
		$personal_desc = $row['personal_desc'];
		/*echo $username;
		echo $fn;
		echo $ln;
		echo $PNo;
		echo $email;
		echo $gender;
		echo $lno;
		echo $Edate;
		echo $spec_data;
		echo $personal_desc;*/
	}
}		
		
		
	 
echo <<<EOT
<div id="carbonForm">
<form name="reg"  action="code_exec_update.php" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
* required field	 

	
	<div>	
	<div class="formRow">
            <div class="label">
                <label for="Uname">Username*:</label>
            </div>
            
            <div class="field">
                <input type="text" name="Uname" value= "$username" readonly/>
            </div>
    </div>	
	
	
		
	
	
	
	
	<div class="formRow">
            <div class="label">
                <label for="Fname">FirstName*:</label>
            </div>
            
            <div class="field">
                <input type="text" name="Fname" value= "$fn"/>
            </div>
    </div>	
	
	
		
	<div class="formRow">
            <div class="label">
                <label for="Lname">LastName*:</label>
            </div>
            
            <div class="field">
                <input type="text" name="Lname" value= "$ln"/>
            </div>
    </div>	
	
	<div class="formRow">
            <div class="label">
                <label for="email">Email*:</label>
            </div>
            
            <div class="field">
                <input type="text" name="email" value= "$email"/>
            </div>
    </div>	
		
	<div class="formRow">
            <div class="label">
                <label for="PNo">Phone*:</label>
            </div>
            
            <div class="field">
                <input type='tel' pattern='\d{10}' name="PNo" value= "$PNo"/>
            </div>
     </div>	

	
	<div class="formRow">
            <div class="label">
                <label for="gender">Gender*:</label>
            </div>
           
            <div class="field">
                <input type="radio" name="gender" value="Male" checked="checked">Male<br>			
				<input type="radio" name="gender" value="Female">Female<br>
            </div>
     </div>

    

   <div class="formRow">
            <div class="label">
                <label for="LNum">License#*:</label>
            </div>
            
            <div class="field">
                <input type="text" name="LNum" value= "$lno"/>
            </div>
    </div>	
	
		
	<div class="formRow">
            <div class="label">
                <label for="EDate">ExpiryDate*:</label>
            </div>
            
            <div class="field">
                <input type="date" name="EDate" min="2014-03-31" value= "$Edate"/>
            </div>
    </div>	
		
	<div class="formRow">
            <div class="label">
                <label for="spec">Specialization*:</label>
            </div>
            
            <div class="field">
                <input type="text" name="spec" value= "$spec_data"/>
            </div>
    </div>	
		
	<div class="formRow">
            <div class="label">
                <label for="desc">Description:</label>
            </div>
            
            <div class="field">
                <textarea name="desc" rows="5" cols="40"  style="background: #E0EEE0;">$personal_desc</textarea>  <br/><br/>
            </div>
    </div>	
		
	<div class="formRow">
            <div class="label">
                <label for="uploaded">Certificate*:</label>
            </div>
            
            <div class="field">
                <input name="uploaded" type="file" />
            </div>
    </div>	
	</div>
	
	
	<br/><br/><br/><br/>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	<input type="submit" name="Register" value="Update"/>
	
	
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
