<?php

define('ROOT_DIR', '../');
include('connection.php');
require_once(ROOT_DIR . 'Domain/Access/namespace.php');
require_once(ROOT_DIR . 'lib/Config/namespace.php');
require_once(ROOT_DIR . 'lib/Common/namespace.php');
require_once(ROOT_DIR . 'lib/Application/Attributes/namespace.php');
include(ROOT_DIR . 'Pages/SchedulePage.php');
//include(ROOT_DIR . 'Domain/Access/UserSessionRepository.php');

if (isset($_GET['sc_id'])){
	$uid = $_GET['sc_id'];
/*	$page = new SchedulePage();
	$user = UserSessionRepository::LoadByUserID($uid);
	$page->ProcessPageLoadForSc($user);*/
}
else {
	//header("location: search.php");
}

?>