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

$update_query= "UPDATE  scprofile set CenterName='$cname',SCaddress='$addr',city='$city',state='$state',zip='$zip',SCphone='$phone',email='$email',staff_size='$size',details='$details' Where SCuser_name='$uname'";
$result=mysql_query($update_query,$bd);
echo "First update " . $update_query;

$update_query1= "UPDATE users set fname='$cname',email='$email' Where username='$uname'";
$result1=mysql_query($update_query1,$bd);
echo "Second update " . $update_query1;

if($result== false || $result1=false)
{
	echo" Update failed";
	die();
}

header("location: dashboard.php");

mysql_close($bd);
?>