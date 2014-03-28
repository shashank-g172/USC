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

$query= "SELECT * FROM docprofile where duser_name='$uname'";
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
/*$query = "INSERT INTO users (email, password, fname, lname, username, salt, status_id) VALUES ('$email', '$encryptedPassword', '$fname', '$lname', '$uname', '$salt', '1')";
$result = mysql_query($query);

if ($result === false)
{
	header("location: docsign.php?remarks=fail");
	mysql_close($bd);

}
*/
$query = "SELECT user_id from users where username = '$uname'";
$result1 = mysql_query($query,$bd);
if($result1)
{
	while($row = mysql_fetch_array($result1))
	{
		$uid = $row['user_id'];
		echo "User id ", $uid;
		if ($desc) {
			$query = "INSERT INTO docprofile (user_id, duser_name, doctor_fname,doctor_lname,phone_no,email,gender,license_no,expirydate,spec_data,personal_desc )VALUES('$uid', '$uname', '$fname', '$lname', '$PNo', '$email', '$gender', '$LNum', '$EDate', '$spec', '$desc')";
		}
		else {
			$query = "INSERT INTO docprofile (user_id, duser_name, doctor_fname,doctor_lname,phone_no,email,gender,license_no,expirydate,spec_data )VALUES('$uid', '$uname', '$fname', '$lname', '$PNo', '$email', '$gender', '$LNum', '$EDate', '$spec')";
		}
		$result = mysql_query($query);
		echo $query;
		if ($result === false)
		{
			//header("location: docsign.php?remarks=fail");
			//mysql_close($bd);
		
		}
	}
	
}

//header("location: docsign.php?remarks=success");
mysql_close($bd);
?>