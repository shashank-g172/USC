<?php 
include('connection.php');

$username = $_POST["username"];
$location = $_POST["location"];

if (isset($username) && $username)
{
	echo "In username\n";
	$query = "select user_id, scuser_name from scprofile where SCuser_name like '%$username%'";
	$result=mysql_query($query,$bd);
	if($result== false || $result1=false)
	{
		die();
	}
	else
	{
		while ($row = mysql_fetch_array($result)) {
			$userid = $row['user_id'];
			$username = $row['scuser_name'];
			echo $userid . " " . $username;
		}
	}
	mysql_close($bd);
}

elseif (isset($location) && $location)
{
	echo "In location";
	echo $_POST["location"];
	$query = "select user_id, scuser_name, SCAddress, city, state, zip from scprofile where SCAddress like '%$location%' or city like '%$location%' or state like '%$location%' or zip like '%$location%'";
	$result=mysql_query($query,$bd);
	if($result== false || $result1=false)
	{
		die();
	}
	else
	{
		while ($row = mysql_fetch_array($result)) {
			echo "row exists";
			$userid = $row['user_id'];
			$username = $row['scuser_name'];
			echo $userid . " " . $username;
		}
	}
	mysql_close($bd);
}
?>

<html>
<head>
</head>
<body>
<p> Successfully linked</p>
</body>
</html>