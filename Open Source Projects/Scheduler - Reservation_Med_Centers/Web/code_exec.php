<?php
session_start(); 
define('ROOT_DIR', '../');
include('connection.php');
require_once(ROOT_DIR . 'lib/Database/Commands/Commands.php');
require_once(ROOT_DIR . 'lib/Application/Authentication/PasswordEncryption.php');
require_once(ROOT_DIR . 'lib/Application/Reservation/ReservationEvents.php');
require_once(ROOT_DIR . 'Domain/namespace.php');
require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'Domain/User.php');
require_once(ROOT_DIR . 'lib/Application/Authentication/Registration.php');
require_once(ROOT_DIR . 'lib/Application/Authentication/IRegistration.php');
require_once(ROOT_DIR . 'lib/Application/Authentication/IAuthentication.php');
require_once(ROOT_DIR . 'lib/Application/Authentication/Authentication.php');
require_once(ROOT_DIR . 'lib/Application/Authentication/WebAuthentication.php');

$uname=$_POST['Uname'];
$password=$_POST['password'];
$fname=$_POST['Fname'];
$lname=$_POST['Lname'];
$email=$_POST['email'];
$PNo=$_POST['PNo'];
$gender=$_POST['gender'];
$LNum=$_POST['LNum'];
$EDate=$_POST['EDate'];
$spec=$_POST['spec'];
$desc=$_POST['desc'];
$image = $_FILES['uploaded']['name'];



$query= "SELECT * FROM users where username='$uname'";
$result = mysql_query($query,$bd);

if (!$result) {
    
    header("location: docsign.php?remarks=dup");	
   mysql_close($bd);
  
}


$num_rows = mysql_num_rows($result);
if($num_rows > 0)

{
    header("location: docsign.php?remarks=dup");
	mysql_close($bd);   
    die();

}

$registration = new Registration();
$user = $registration->Register($uname, $email, $fname, $lname, $password, "America/Chicago", "en_us", 1, array(), array());

$query = "SELECT user_id from users where username = '$uname'";
$result1 = mysql_query($query,$bd);
if($result1)
{
	while($row = mysql_fetch_array($result1))
	{
		$uid = $row['user_id'];
		echo "User id ", $uid;
		if ($desc) {
			$query = "INSERT INTO docprofile (user_id, duser_name, doctor_fname,doctor_lname,phone_no,email,gender,license_no,expirydate,spec_data,personal_desc, certificate)VALUES('$uid', '$uname', '$fname', '$lname', '$PNo', '$email', '$gender', '$LNum', '$EDate', '$spec', '$desc','$image')";
		}
		else {
			$query = "INSERT INTO docprofile (user_id, duser_name, doctor_fname,doctor_lname,phone_no,email,gender,license_no,expirydate,spec_data,certificate)VALUES('$uid', '$uname', '$fname', '$lname', '$PNo', '$email', '$gender', '$LNum', '$EDate', '$spec','$image')";
		}
		$result = mysql_query($query);
		if ($result === false)
		{
			header("location: docsign.php?remarks=fail");
			
			//header("location: redirect.html");
			mysql_close($bd);
		
		}
	}
	
}

header("location: dashboard.php");
//header("location: redirect.html");
mysql_close($bd);
?>