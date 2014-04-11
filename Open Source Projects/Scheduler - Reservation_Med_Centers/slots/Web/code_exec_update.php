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


$update_query= "UPDATE docprofile set doctor_fname='$fname',doctor_lname='$lname',phone_no='$PNo',email='$email',gender='$gender',license_no='$LNum',expirydate='$EDate',spec_data='$spec',personal_desc='$desc', certificate1='$image' Where duser_name='$uname'";
$result=mysql_query($update_query,$bd);

$update_query1= "UPDATE users set fname='$fname',lname='$lname',email='$email' Where username='$uname'";
$result1=mysql_query($update_query1,$bd);

if($result== false || $result1=false)
{
	echo" Update failed";
	die();
}

header("location: dashboard.php");

mysql_close($bd);
?>