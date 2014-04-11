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
$cname=$_POST['cname'];
$addr=$_POST['addr'];
$city=$_POST['city'];
$state=$_POST['state'];
$zip=$_POST['zip'];
$email=$_POST['email'];
$phone=$_POST['PNo'];
$size=$_POST['size'];
$details=$_POST['details'];

if($details=="")
{
   $details="NULL";
}

$query= "SELECT * FROM scprofile where SCuser_name='$uname'";
$result = mysql_query($query,$bd);

if (!$result) {
    
   header("location: scsign.php?remarks=dup");	
   mysql_close($bd);
  
}


$num_rows = mysql_num_rows($result);
if($num_rows > 0)

{
    header("location: scsign.php?remarks=dup");
	mysql_close($bd);   
    die();

}

$registration = new Registration();
$user = $registration->Register($uname, $email, $cname, "", $password, "America/Chicago", "en_us", 1, array(), array());

$query = "SELECT user_id from users where username = '$uname'";
$result1 = mysql_query($query,$bd);
if($result1)
{
	while($row = mysql_fetch_array($result1))
	{
		$uid = $row['user_id'];
		echo "User id ", $uid;
		
		if ($details) {
			$query = "INSERT INTO scprofile (user_id, SCuser_name,CenterName,SCaddress,city,stat,zip,SCphone,email,staff_size,details )VALUES('$uid', '$uname', '$cname', '$addr', '$city', '$state', '$zip', '$phone', '$email', '$size', '$details')";
		}
		else {
			$query = "INSERT INTO scprofile (user_id, SCuser_name,CenterName,SCaddress,city,stat,zip,SCphone,email,staff_size )VALUES('$uid', '$uname', '$cname', '$addr', '$city', '$state', '$zip', '$phone', '$email', '$size')";	
		}
		$result = mysql_query($query);
		echo $query;
		$query1 = "INSERT INTO user_groups (user_id, group_id) VALUES ('$uid', '4')";
		echo $query1;
		$result = mysql_query($query1);
		if ($result === false)
		{
				header("location: docsign.php?remarks=fail");
				mysql_close($bd);

		}
	}

}

header("location: html/redirect.html");
mysql_close($bd);
?>