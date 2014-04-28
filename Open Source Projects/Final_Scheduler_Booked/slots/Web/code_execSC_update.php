<?php
session_start();
define('ROOT_DIR', '../');
include('connection.php');
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
$cname=$_POST['cname'];
$addr=$_POST['addr'];
$city=$_POST['city'];
$state=$_POST['state'];
$zip=$_POST['zip'];
$email=$_POST['email'];
$phone=$_POST['PNo'];
$size=$_POST['size'];
$details=$_POST['details'];
$Contact_Person=$_POST['cperson'];
$Contact_Num=$_POST['ContactPNo'];
$Designation=$_POST['designation'];

if($details=="")
{
   $details="NULL";
}

if ($_FILES['image'])
	{
	   
	    $file_name = $_FILES['image']['name'];
	    $file_size =$_FILES['image']['size'];
	    $file_tmp =$_FILES['image']['tmp_name'];
	    $file_type=$_FILES['image']['type'];   
	   
	}

else
{
	echo " NADA";
}

$newname=$uname;
$extension=".jpg";
$renamed_name=$newname.'_image'.$extension;
 	

	


$update_query= "UPDATE  scprofile set CenterName='$cname',SCaddress='$addr',city='$city',state='$state',zip='$zip',SCphone='$phone',email='$email',staff_size='$size',details='$details', poc_name= '$Contact_Person',poc_contact='$Contact_Num', poc_designation='$Designation', image='$renamed_name' Where SCuser_name='$uname'";
$result=mysql_query($update_query,$bd);
//
$update_query1= "UPDATE users set fname='$cname',email='$email',phone='$phone' Where username='$uname'";
$result1=mysql_query($update_query1,$bd);
//echo "Second update " . $update_query1;

if($result== false || $result1=false)
{
	echo" Update failed";
	die();
}

if($result== true || $result1=true)
{
	if($file_tmp)
	move_uploaded_file($file_tmp,"certificates/".$renamed_name);;
}


header("location: dashboard.php");

mysql_close($bd);
?>