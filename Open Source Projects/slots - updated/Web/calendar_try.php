<?php

define('ROOT_DIR', '../');
include('connection.php');
require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'lib/Config/namespace.php');
require_once(ROOT_DIR . 'lib/Common/namespace.php');
require_once(ROOT_DIR . 'lib/Application/Attributes/namespace.php');
require_once(ROOT_DIR . 'Pages/SchedulePage.php');
require_once(ROOT_DIR . 'Domain/Access/UserRepository.php');
require_once(ROOT_DIR . 'Domain/Access/ScheduleUserRepository.php');
require_once(ROOT_DIR . 'lib/Application/Schedule/ScheduleResourceFilter.php');

if (isset($_GET['sc_id'])){
	$uid = $_GET['sc_id'];
	
	$resources = array();
	
	$page = new SchedulePage();
	
	$user = new UserSession($uid);
	$user->Timezone="America/Los_Angeles";
	$page->ProcessPageLoadForSc($user);
}
else {
	//header("location: search.php");
}

?>