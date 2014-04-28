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

$desired_dir="certificates";




/*$allValues = array_values($original_names);
echo $allValues[0];
echo $allValues[1];
echo $allValues[2];*/


$renamed_names = array();
$NullString="NULL";
for($i=1;$i<4;$i++)
{
	if($original_names[$i-1])
    {

	$newname=$uname;
    $extension=".jpg";
    $Cname=$newname.'_cert'.$i.$extension;
    array_push($renamed_names, $Cname);
	}

	else
	{
		array_push($renamed_names, $NullString);
	}
	
}



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
$additionalFields = array('phone' => $PNo, 'organization' => null, 'position' => null);
$user = $registration->Register($uname, $email, $fname, $lname, $password, "America/Los_Angeles", "en_us", 1, $additionalFields);

$query = "SELECT user_id from users where username = '$uname'";
$result1 = mysql_query($query,$bd);
if($result1)
{   
	while($row = mysql_fetch_array($result1))
	{
		$uid = $row['user_id'];
	//	echo "User id ", $uid;
		$Edate_format = $date = "'".date('Y-m-d', strtotime(str_replace('-', '/', $EDate)))."'";
		if ($desc) {
			
			$query = "INSERT INTO docprofile (user_id, duser_name, doctor_fname,doctor_lname,phone_no,email,gender,license_no,expirydate,spec_data,personal_desc, certificate1,certificate2,certificate3)VALUES('$uid', '$uname', '$fname', '$lname', '$PNo', '$email', '$gender', '$LNum',  $Edate_format, '$spec', '$desc','$renamed_names[0]','$renamed_names[1]','$renamed_names[2]')";
			//echo $query;
		}
		else {
			$query = "INSERT INTO docprofile (user_id, duser_name, doctor_fname,doctor_lname,phone_no,email,gender,license_no,expirydate,spec_data,certificate1,certificate2,certificate3)VALUES('$uid', '$uname', '$fname', '$lname', '$PNo', '$email', '$gender', '$LNum',  $Edate_format, '$spec','$renamed_names[0]','$renamed_names[1]','$renamed_names[2]')";
			//echo $query;
		}
		$result = mysql_query($query);

		if(result)
		{

			if($original_names[0])
			move_uploaded_file($original_names[0],"certificates/".$renamed_names[0]);

			if($original_names[1])
			move_uploaded_file($original_names[1],"certificates/".$renamed_names[1]);

			if($original_names[2])
			move_uploaded_file($original_names[2],"certificates/".$renamed_names[2]);
		}

		
		if ($result === false)
		{
			header("location: docsign.php?remarks=fail");
			
			//header("location: redirect.html");
			mysql_close($bd);
		
		}
	}
	
}

//header("location: dashboard.php");
header("location: redirect.php");
mysql_close($bd);

 ?>