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

<style>
.error {color: #FF0000;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Doctor Sign up</title>
<meta name="keywords" content="" />
<meta name="description" content="" />

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" rel="stylesheet" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/kendo.common.min.css" rel="stylesheet">
<link href="css/kendo.default.min.css" rel="stylesheet">

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>









		<!-- ****************************************************************************************************************** -->

			<div style="padding:20px">
				<img align="middle" style="width:25%; text-align:center" src="images/doctorprofile.jpeg" width="200" height="200" alt="" />
			</div>

		<!-- ****************************************************************************************************************** -->


	
<div id="wrapper">
	<p><span class="error">* required field.</span></p>
<form name="reg"  action="code_exec.php" onsubmit="return validateForm()" method="post">
	 
<?php 
		
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
		echo 'Username Duplicate. Retry';
		}
?>	 
	<br>
	<b>Username</b>: &emsp;&emsp;&emsp;&emsp;<input type="text" name="Uname" />  <br/>
	<b>Password</b>: &nbsp;&emsp;&emsp;&emsp;&emsp;<input type="password" name="password" />    <br/>
	<b>Firstname</b>: &nbsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;<input type="text" name="Fname" />     <br/>
	<b>Lastname</b>: &emsp;&emsp;&emsp;&emsp;<input type="text" name="Lname" />     <br/>
	<b>Email</b>: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="email" name="email" />    <br/>
	<b>Phone Number</b>:&nbsp;&nbsp;&emsp;<input type='tel' pattern='\d{10}'  name="PNo">  <br/>
	<b>Gender</b>: &emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="gender" value="Male" checked="checked">Male<br>			
	&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="radio" name="gender" value="Female">Female<br>
	
	<b>License Number</b>&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="LNum" />    <br/>
	<b>Expiry Date</b>: &emsp;&emsp;&emsp;<input type="date" name="EDate" />   <br/>
	<b>Specialization</b>:&emsp;&emsp;<input type="text" name="spec" />  <br/>
	<b>Description</b>: &emsp;&emsp;&emsp;<textarea name="desc" rows="5" cols="40"></textarea>  <br/><br/>
	
	<input type="submit" name="Register" value="Register"/>
	</form>
	

</div>
				
							
				
							
</div>
			

<div id="copyright" class="container">
	<p>Copyright (c) 2013 SurgeryAssist.com. All rights reserved. | Support by Team 03 from USC </a> | Thank to <a href="http://www.freecsstemplates.org/" rel="nofollow">FreeCSSTemplates.org</a>.</p>
</div>
</body>
</html>
