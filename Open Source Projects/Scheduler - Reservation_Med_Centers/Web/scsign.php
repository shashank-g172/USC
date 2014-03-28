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
var c=document.forms["reg"]["cname"].value;
var d=document.forms["reg"]["addr"].value;
var e=document.forms["reg"]["city"].value;
var f=document.forms["reg"]["state"].value;
var g=document.forms["reg"]["zip"].value;
var h=document.forms["reg"]["email"].value;
var i=document.forms["reg"]["PNo"].value;
var j=document.forms["reg"]["size"].value;
var k=document.forms["reg"]["details"].value;
//alert(a+' '+b+' '+c+' '+d+' '+e+' '+f+' '+g+' '+h+' '+i+' '+j+' '+k);

if ((a==null || a=="") && (b==null || b=="") && (c==null || c=="") && (d==null || d=="") && (e==null || e=="") && (g==null || g=="") && (h==null || h=="") && (i==null || i=="") && (j==null || j=="") )
	
	{
		alert("All Field must be filled out");
		return false;
    }
	
if (a==null || a=="")
  {
  alert("User name must be filled out");
  return false;
  }
  
if (b==null || b=="")
  {
  alert("Password must be filled out");
  return false;
  }
  
if (c==null || c=="")
  {
  alert("Surgery center name must be filled out");
  return false;
  }
  
if (d==null || d=="")
  {
  alert("Address must be filled out");
  return false;
  }
  
if (e==null || e=="")
  {
  alert("city  must be filled out");
  return false;
  }
  
if (g==null || g=="")
  {
  alert("zipcode must be filled out");
  return false;
  }
  
  if (h==null || h=="")
  {
  alert("Email must be filled out");
  return false;
  }
  
if (i==null || i=="")
  {
  alert("Phone Number must be filled out");
  return false;
  }

if (j==null || j=="")
  {
  alert("Staff size must be filled out");
  return false;
  }  

}
</script>

<style>
.error {color: #FF0000;}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Surgery Centre Sign up</title>
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
				<img align="middle" style="width:25%; text-align:center" src="images/01.jpg" width="200" height="200" alt="" />
			</div>

		<!-- ****************************************************************************************************************** -->


	
<div id="wrapper">
	<p><span class="error">* required field.</span></p>
<form name="reg"  action="code_execSC.php" onsubmit="return validateForm()" method="post">

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
	<b>Username</b>: &nbsp;&emsp;&emsp;&nbsp;&nbsp;<input type="text" name="Uname" />  <br/>
	<b>Password</b>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;<input type="password" name="password" />    <br/>
	<b>Center Name</b>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="cname" />    <br/>
	<b>Address</b>: &nbsp;&nbsp;&nbsp;&nbsp;&emsp;&emsp;&emsp;<input type="text" name="addr" />     <br/>
	<b>City</b>: &nbsp;&nbsp;&emsp;&nbsp;&emsp;&emsp;&emsp;&emsp;<input type="text" name="city" />     <br/>
	
	
	<b>State &nbsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;</b><select name="state" width:230px; > 
	
	<option value="AL">Alabama</option> <option value="AK">Alaska</option> <option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option> <option value="CA" selected="selected" >California</option>	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>	<option value="DE">Delaware</option> <option value="DC">District of Columbia</option>
	<option value="FL">Florida</option>	<option value="GA">Georgia</option>	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option> <option value="IL">Illinois</option> <option value="IN">Indiana</option>
	<option value="IA">Iowa</option> <option value="KS">Kansas</option> <option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option> <option value="ME">Maine</option>	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option> <option value="MI">Michigan</option> <option value="MN">Minnesota</option>	
	<option value="MS">Mississippi</option>	<option value="MO">Missouri</option> <option value="MT">Montana</option>
	<option value="NE">Nebraska</option> <option value="NV">Nevada</option>	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option> <option value="NM">New Mexico</option><option value="NY">New York</option>
	<option value="NC">North Carolina</option>	<option value="ND">North Dakota</option>	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>	<option value="OR">Oregon</option>	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>	<option value="SC">South Carolina</option>	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>	<option value="TX">Texas</option>	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>	<option value="VA">Virginia</option>	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>	<option value="WI">Wisconsin</option>	<option value="WY">Wyoming</option>
	</select> <br/>
	
	<b>Zipcode</b>&emsp;&emsp;&emsp;&emsp;&nbsp; <input type="text" name="zip" />    <br/>
	<b>Email</b>: &emsp;&emsp;&emsp;&emsp;&emsp;<input type="email" name="email" />    <br/>	
	<b>Phone Number</b>:&nbsp;&nbsp;<input type='tel' pattern='\d{10}'  name="PNo">  <br/>	
	<b>Staff size</b>: &nbsp;&emsp;&emsp;&emsp;<input type="text" name="size" />   <br/>
	<b>Details</b>:&emsp;&emsp;&nbsp;&nbsp;&emsp;&emsp;<input type="text" name="details" />  <br/>	<br/>
	
	&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	<input type="submit" name="Register"/>
	</form>
	

</div>
				
							
				
							
</div>
			

<div id="copyright" class="container">
	<p>Copyright (c) 2013 SurgeryAssist.com. All rights reserved. | Support by Team 03 from USC </a> | Thank to <a href="http://www.freecsstemplates.org/" rel="nofollow">FreeCSSTemplates.org</a>.</p>
</div>
</body>
</html>
