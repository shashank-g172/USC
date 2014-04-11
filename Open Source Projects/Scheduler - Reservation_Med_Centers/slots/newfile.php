<?php
session_start();
define('ROOT_DIR', '../');
include('connection.php');
include(ROOT_DIR . 'lib/Database/Commands/Commands.php');
require_once(ROOT_DIR . 'lib/Application/Authentication/PasswordEncryption.php');

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
echo $num_rows;
if($num_rows > 0)

{
	header("location: docsign.php?remarks=dup");
	mysql_close($bd);
	die();

}

$passwordEncryption = new PasswordEncryption();
$encryptedPassword = $passwordEncryption->EncryptPassword($password)->EncryptedPassword();
$salt = $passwordEncryption->EncryptPassword($password)->Salt();
$query = "INSERT INTO users (email, password, fname, lname, username, salt) VALUES ('$email', '$encryptedPassword', '$fname', '$lname', '$uname', '$salt'";
$result = mysql_query($query);
echo $query;

if ($result === false)
{
	header("location: docsign.php?remarks=fail");
	mysql_close($bd);

}

$query = "SELECT user_id from users where username is '$uname'";
$result = mysql_query($query);

while($row = mysqli_fetch_array($result))
{
	$uid = $row['user_id'];
	$result = mysql_query("INSERT INTO docprofile (user_id, duser_name, doctor_fname,doctor_lname,phone_no,email,gender,license_no,expirydate,spec_data,personal_desc )VALUES('$uid', $uname', '$fname', '$lname', '$PNo', '$email', '$gender', '$LNum', '$EDate', '$spec', '$desc')");
	if ($result === false)
	{
		header("location: docsign.php?remarks=fail");
		mysql_close($bd);

	}

}

header("location: docsign.php?remarks=success");
mysql_close($bd);
?>