<?php

define('ROOT_DIR', '../');
include('connection.php');
require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'lib/Config/namespace.php');
require_once(ROOT_DIR . 'lib/Common/namespace.php');
require_once(ROOT_DIR . 'lib/Application/Attributes/namespace.php');
require_once(ROOT_DIR . 'lib/Common/DateRange.php');
require_once(ROOT_DIR . 'Pages/SchedulePage.php');
require_once(ROOT_DIR . 'Domain/Access/UserRepository.php');
require_once(ROOT_DIR . 'Domain/Access/ScheduleUserRepository.php');
require_once(ROOT_DIR . 'Presenters/SchedulePageBuilder.php');

session_start();

$startdate = new Date($_SESSION['startdate']);
$enddate = new Date($_SESSION['enddate']);

if (isset($_GET['sc_id'])){
	$uid = $_GET['sc_id'];
	
	$page = new SchedulePage();
	
	$user = new UserSession($uid);
	$query = "select user_id, centername, SCAddress, city, state, zip, SCPhone, email, insurance, image, details from scprofile where user_id = $uid";
	$result=mysql_query($query,$bd);
	if($result== false || $result1=false)
	{
		die();
	}
	else
	{
		while ($row = mysql_fetch_array($result)) {
			$username = $row['centername'];
			$address = $row['SCAddress'];
			$city = $row['city'];
			$state = $row['state'];
			$zip = $row['zip'];
			$phone = $row['SCPhone'];
			$email = $row['email'];
			$insurance = $row['insurance'];
			$image = $row['image'];
			$details = $row['details'];
			$complete_address = $address . " " . $city ." ". $state ." ".$zip;
			$_SESSION['uid'] = $uid;
			$_SESSION['centername'] = $username;
			$_SESSION['address'] = $complete_address;
			$_SESSION['phone'] = $phone;
			$_SESSION['email'] = $email;
			$_SESSION['insurance'] = $insurance;
			$_SESSION['image'] = $image;
			$_SESSION['details'] = $details;
		}
	}
	$user->Timezone="America/Los_Angeles";
	if ($startdate)
	{
		//$adjustedDateRange = new DateRange($startdate, $enddate);
		//$page->SetDisplayDates($adjustedDateRange);
		$_GET[QueryStringKeys::START_DATE] = $startdate;
	}
	$page->ProcessPageLoadForSc($user);
}
else {
	//header("location: search.php");
}

?>