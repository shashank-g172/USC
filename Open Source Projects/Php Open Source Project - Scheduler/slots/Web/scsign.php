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


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Surgery Centre Sign up</title>
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
		
		if (!isset($_GET['remarks'])) {$remarks=""; }
		else {$remarks=$_GET['remarks']; }
		
		if ($remarks==null and $remarks=="")
		{
		  
		}
		if ($remarks=='success')
		{
		 echo '<p align="center"><b>Username Duplicate. Retry</b></p>';
		}
		if ($remarks=='dup')
		{
		
		//echo '<b>Username Duplicate. Retry</b>';
		//echo '<span style="text-align:center;"><b>Username Duplicate. Retry</b></span>';
		echo '<p align="center"><b>Username Duplicate. Retry</b></p>';
		}
?>	 
	
<div id="carbonForm">
<form enctype="multipart/form-data" name="reg"  action="code_execSC.php" onsubmit="return validateForm()" method="post">
* required field



 
 <div>
	<div class="formRow">
            <div class="label">
                <label for="Uname">Username*:</label>
            </div>
            
            <div class="field">
                <input type="text" name="Uname"/>
            </div>
    </div>

	<div class="formRow">
            <div class="label">
                <label for="password">Password*:</label>
            </div>
            
            <div class="field">
                <input type="password" name="password"/>
            </div>
    </div>
	
	<div class="formRow">
            <div class="label">
                <label for="cname">CenterName*:</label>
            </div>
            
            <div class="field">
                <input type="text" name="cname"/>
            </div>
    </div>
	
	<div class="formRow">
            <div class="label">
                <label for="addr">Address*:</label>
            </div>
            
            <div class="field">
                <input type="text" name="addr"/>
            </div>
    </div>
	
	<div class="formRow">
            <div class="label">
                <label for="city">City*:</label>
            </div>
            
            <div class="field">
                <input type="text" name="city"/>
            </div>
    </div>
	
	<div class="formRow">
            <div class="label">
                <label for="state">State*:</label>
            </div>
            
            <div class="field">
                <select name="state"  style="background: #E0EEE0; width:175px; height:30px;" > 
	
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
	</select>
            </div>
    </div>
	
	<div class="formRow">
            <div class="label">
                <label for="zip">Zipcode*:</label>
            </div>
            
            <div class="field">
                <input type="text" name="zip"/>
            </div>
    </div>
	
	<div class="formRow">
            <div class="label">
                <label for="email">Email*:</label>
            </div>
            
            <div class="field">
                <input type="email" name="email" />
            </div>
    </div>
	
	<div class="formRow">
            <div class="label">
                <label for="PNo">PhoneNo*:</label>
            </div>
            
            <div class="field">
                <input type='tel' pattern='\d{10}'  name="PNo"> 
            </div>
    </div>
	
	<div class="formRow">
            <div class="label">
                <label for="size">StaffSize*:</label>
            </div>
            
            <div class="field">
                <input type="text" name="size" />
            </div>
    </div>

    <div class="formRow">
            <div class="label">
                <label for="cperson">ContactPerson*:</label>
            </div>
            
            <div class="field">
                <input type="text" name="cperson"/>
            </div>
    </div>
  
  <div class="formRow">
            <div class="label">
                <label for="designation">Designation*:</label>
            </div>
            
            <div class="field">
                <input type="text" name="designation" />
            </div>
    </div>  

    <div class="formRow">
            <div class="label">
                <label for="ContactPNo">ContactPhoneNo*:</label>
            </div>
            
            <div class="field">
                <input type='tel' pattern='\d{10}'  name="ContactPNo"> 
            </div>
    </div>
	
	<div class="formRow" >
            <div class="label">
                <label for="details">Details*:</label>
            </div>
            
            <div class="field">
                <textarea name="details" rows="6" cols="30" maxlength="99" style="background: #E0EEE0;"></textarea>  <br/><br/>
            </div>
    </div>

  
   <div class="formRow">
            <div class="label">
                <label for="uploaded">Image:</label>
            </div>
            
            <div class="field">
               
                <input name="image" type="file" />
            </div>
    </div>  
    
	
</div>	
	<br/><br/><br/><br/>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
	<input type="submit" name="Register" value="Register"/>
	</form>
	
</div>
</div>

<div class="img">
<img  src="img/footer.jpg" width='100%' />
</div>			


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
		
</body>
</html>
