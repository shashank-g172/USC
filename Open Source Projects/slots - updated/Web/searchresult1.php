<?php 
include('connection.php');

$username = $_POST["username"];
$location = $_POST["location"];

if (isset($username) && $username)
{
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
	$query = "select user_id, scuser_name, SCAddress, city, state, zip from scprofile where SCAddress like '%$location%' or city like '%$location%' or state like '%$location%' or zip like '%$location%'";
	$result=mysql_query($query,$bd);
	if($result== false || $result1=false)
	{
		die();
	}
	else
	{
		$addresses = array("");
		$userids = array("");
		$usernames = array("");
		while ($row = mysql_fetch_array($result)) {
			$userid = $row['user_id'];
			$username = $row['scuser_name'];
			$address = $row['SCAddress'];
			$city = $row['city'];
			$state = $row['state'];
			$zip = $row['zip'];
			$complete_address = $address . " " . $city ." ". $state ." ".$zip;
			array_push($addresses, $complete_address);
			array_push($userids, $userid);
			array_push($usernames, $username);
		}
		
		$length = count($usernames);
		for ($i = 0; $i < $length; $i++) {
			print $usernames[$i];
			print $addresses[$i];
		}
	}
	
	mysql_close($bd);
}
?>