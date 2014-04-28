<?php

ini_set('display_errors',1);


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
    
    $NullString="NULL";

	
	$newname=$uname;
    $extension=".jpg";
    $renamed_name=$newname.'_image'.$extension;
    

  $insurance;
	$comma=0;
	
	$len = count($_POST['insurance']);
	for ($i=0; $i < $len; $i++)
	{
		if($comma==0)
		{
		  $insurance.= $_POST['insurance'][$i];
		  $comma++;
		}
		else
		{	
		$insurance.= " ";
		$insurance.= $_POST['insurance'][$i];
		}	
		
	} 
 

$query= "SELECT * FROM scprofile where SCuser_name='$uname'";
$result = mysql_query($query,$bd);




$num_rows = mysql_num_rows($result);
if($num_rows > 0)

{
    header("location: scsign.php?remarks=dup");
	mysql_close($bd);   
    die();

}

	

$registration = new Registration();
$additionalFields = array('phone' => $phone, 'organization' => null, 'position' => null);
$user = $registration->Register($uname, $email, $cname, "", $password, "America/Chicago", "en_us", 1, $additionalFields);

$query = "SELECT user_id from users where username = '$uname'";
$result1 = mysql_query($query,$bd);
if($result1)
{
	while($row = mysql_fetch_array($result1))
	{
		$uid = $row['user_id'];
	//	echo "User id ", $uid;
		
		if ($details) {
			$query = "INSERT INTO scprofile (user_id, SCuser_name,CenterName,SCaddress,city,state,zip,SCphone,email,staff_size,details,poc_name,poc_contact, poc_designation, image,insurance )VALUES('$uid', '$uname', '$cname', '$addr', '$city', '$state', '$zip', '$phone', '$email', '$size', '$details','$Contact_Person','$Contact_Num','$Designation','$renamed_name','$insurance')";
		}
		else {
			$query = "INSERT INTO scprofile (user_id, SCuser_name,CenterName,SCaddress,city,state,zip,SCphone,email,staff_size )VALUES('$uid', '$uname', '$cname', '$addr', '$city', '$state', '$zip', '$phone', '$email', '$size')";	
		}
		$result = mysql_query($query);

		if(result)
		{
			 if($file_tmp)
    		 move_uploaded_file($file_tmp,"certificates/".$renamed_name);

		}
		$query1 = "INSERT INTO user_groups (user_id, group_id) VALUES ('$uid', '4')";
		$result = mysql_query($query1);
		if ($result === false)
		{
			header("location: scsign.php?remarks=fail");
				mysql_close($bd);

		}
	}

}

header("location: redirect.php");
mysql_close($bd);

?> 