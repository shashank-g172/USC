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

if(isset($_FILES['files']))
{
   $original_names = array();
   $i=0;
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name )
	{
		$file_name = $key.$_FILES['files']['name'][$key];
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];	
        array_push($original_names, $file_tmp);
	}
} 

$desired_dir="certificates";
$renamed_names = array();



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
for($i=1;$i<4;$i++)
{
	$newname=$uname;
    $extension=".jpg";
    $Cname=$newname.'_cert'.$i.$extension;
    array_push($renamed_names, $Cname);
	
}


	

	

$update_query= "UPDATE docprofile set doctor_fname='$fname',doctor_lname='$lname',phone_no='$PNo',email='$email',gender='$gender',license_no='$LNum',expirydate='$EDate',spec_data='$spec',personal_desc='$desc', certificate1='$renamed_names[0]', certificate2='$renamed_names[1]',certificate3='$renamed_names[2]' Where duser_name='$uname'";
$result=mysql_query($update_query,$bd);

$update_query1= "UPDATE users set fname='$fname',lname='$lname',email='$email' ,phone='$PNo' Where username='$uname'";
$result1=mysql_query($update_query1,$bd);

if($result== false || $result1=false)
{
	echo" Update failed";
	die();
}

if($result== true || $result1=true)
{
	
	if($original_names[0])
	move_uploaded_file($original_names[0],"certificates/".$renamed_names[0]);

	if($original_names[1])
	move_uploaded_file($original_names[1],"certificates/".$renamed_names[1]);

	if($original_names[2])
	move_uploaded_file($original_names[2],"certificates/".$renamed_names[2]);
}

header("location: dashboard.php");

mysql_close($bd);
?>