
<html>
<head>
<link href="css/search.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">

  function initialize(addr) {
    var geocoder;
    var map;
    var address = addr;
    //document.write(address);
  	geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var myOptions = {
      zoom: 15,
      center: latlng,
    mapTypeControl: true,
    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    navigationControl: true,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    if (geocoder) {
      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
          map.setCenter(results[0].geometry.location);
		
            var infowindow = new google.maps.InfoWindow(
                { content: '<b>'+address+'</b>',
                  size: new google.maps.Size(150,50)
                });
		
            var marker = new google.maps.Marker({
                position: results[0].geometry.location,
                map: map,
                title:address
            });
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map,marker);
            });
		
          } else {
            alert("No results found");
          }
        } else {
          alert("Geocode was not successful for the following reason: " + status);
        }
      });
    }
}
</script>
</head>
<!--  <body style="margin:0px; padding:0px;" onload="initialize()"> -->
  		<body style="margin:0px; padding:0px;">
<?php
include('connection.php');
define('ROOT_DIR', '../');
require_once(ROOT_DIR . 'Pages/ProfilePage.php');
require_once('searchprofile.php');
require_once(ROOT_DIR . 'Domain/Access/ReservationViewRepository.php');
require_once(ROOT_DIR . 'Domain/Access/ResourceRepository.php');

$page =  new ProfilePage();
$page->Display('globalheader.tpl');

session_start();

class Slots{
	public $start_date;
	public $end_date;
};

$username = $_POST["username"];
$location = $_POST["location"];
$startdate = $_POST["startdate"];
$enddate = $_POST["enddate"];
$duration = $_POST["duration"];
$blocked_slots = array();
$_SESSION['startdate'] = $startdate;
$_SESSION['enddate'] = $enddate;
$today = date('Y-m-d');

if (isset($username) && $username)
{
	$query = "select user_id, centername, SCAddress, city, state, zip from scprofile where centername like '%$username%'";
	$result=mysql_query($query,$bd);
	$addresses = array("");
	$userids = array("");
	$usernames = array("");
	if($result== false || $result1=false)
	{
		die();
	}
	else
	{
		while ($row = mysql_fetch_array($result)) {
			$userid = $row['user_id'];
			$username = $row['centername'];
			$address = $row['SCAddress'];
			$city = $row['city'];
			$state = $row['state'];
			$zip = $row['zip'];
			$complete_address = $address . " " . $city ." ". $state ." ".$zip;
			array_push($addresses, $complete_address);
			array_push($userids, $userid);
			array_push($usernames, $username);
		}
	}
	mysql_close($bd);
}

elseif (isset($location) && $location)
{
	$query = "select user_id, centername, SCAddress, city, state, zip from scprofile where SCAddress like '%$location%' or city like '%$location%' or state like '%$location%' or zip like '%$location%'";
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
			$username = $row['centername'];
			$address = $row['SCAddress'];
			$city = $row['city'];
			$state = $row['state'];
			$zip = $row['zip'];
			$complete_address = $address . " " . $city ." ". $state ." ".$zip;
			array_push($addresses, $complete_address);
			array_push($userids, $userid);
			array_push($usernames, $username);
		}
	}
	
	mysql_close($bd);
}

elseif ((isset($startdate) && $startdate) || (isset($enddate) && $enddate))
{
	$startdate_date= "'".date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $startdate)))."'";
	$enddate_date= "'".date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $enddate)))."'";
	
	$resources = array();
	$resources_list = ResourceRepository::GetResourceList();
	retrieve_reservations($startdate_date, $enddate_date);
	retrieve_blackouts($startdate_date, $enddate_date);
	foreach ($blocked_slots as $key => $value) {
		usort($blocked_slots[$key], 'date_sort');
	}
	foreach ($resources_list as $res) {
		if (!array_key_exists($res->GetId(), $blocked_slots))
			array_push($resources, $res->GetId());
	}
	foreach ($blocked_slots as $key => $value) {
		$date1 = new DateTime($startdate);
		$date2 = new DateTime($value[0]->start_date);
		$day = $date1->diff($date2)->format("%d");
		$hour = $date1->diff($date2)->format("%H");
		if ($day > 0 || $hour > $duration){
			array_push($resources, $key);
			continue;
		}
		$count = count($value);
		for ($i = 0; $i < $count; $i++){	
			$j = $i + 1;
			$date1= new DateTime($value[$i]->end_date);
			$date2= new DateTime($value[$j]->start_date);
				    
			$day = $date1->diff($date2)->format("%d");
			$hour = $date1->diff($date2)->format("%H");
			if ($day > 0 || $hour > $duration){
				array_push($resources, $key);
				break;
			}
		}
	}
	$addresses = array("");
	$userids = array("");
	$usernames = array("");	
	foreach ($resources as $resource) {
		$query = "SELECT user_id, centername, SCAddress, city, state, zip from scprofile where user_id in (select user_id FROM user_resource_permissions WHERE resource_id = $resource AND permission_id =2)";
		$result = mysql_query($query);
		if($result== false || $result1=false)
		{
			die();
		}
		else
		{
			while ($row = mysql_fetch_array($result)) {
				$userid = $row['user_id'];
				$username = $row['centername'];
				$address = $row['SCAddress'];
				$city = $row['city'];
				$state = $row['state'];
				$zip = $row['zip'];
				$complete_address = $address . " " . $city ." ". $state ." ".$zip;
				if (! in_array($userid, $userids)) {
					array_push($addresses, $complete_address);
					array_push($userids, $userid);
					array_push($usernames, $username);
				}
			}
		}
	}
	mysql_close($bd);
}

$length = count($usernames);
for ($i = 0; $i < $length; $i++) {
	echo '<div style="margin-left:45px; font-size: 20px; " onmouseover="initialize(\''.$addresses[$i].'\')"><a href="searchprofile.php?sc_id='.$userids[$i].'">'.$usernames[$i].'</a></div>';
	//echo "<p>" . $addresses[$i]."</p>";
	echo '<div style="margin-left:45px; font-size: 15px;">' . $addresses[$i].'</div>' ;
}

function date_sort($a, $b)
{
  $ad = new DateTime($a->start_date);
  $bd = new DateTime($b->start_date);
  if ($ad == $bd) {
    return 0;
  }
  $ret_val = ($ad < $bd) ? -1 : 1;
  return ($ad < $bd) ? -1 : 1;
}

function populate_array($key, $slot)
{ 
	global $blocked_slots;
	if(array_key_exists($key, $blocked_slots)) {
		if(is_array($blocked_slots[$key])) {
			$blocked_slots[$key][] = $slot;
		}
		else {
			$blocked_slots[$key] = array($blocked_slots[$key], $slot);
		}
	}
	else {
		$blocked_slots[$key] = array($slot);
	}
}

function retrieve_reservations($startdate, $enddate)
{
	$query = "SELECT resource_id, start_date, end_date FROM reservation_resources 
INNER JOIN reservation_instances ON reservation_instances.series_id = reservation_resources.series_id
WHERE reservation_instances.start_date >= STR_TO_DATE(  ".$startdate.",  '%Y-%m-%d %H:%i:%s' ) 
AND reservation_instances.start_date <= STR_TO_DATE(  ".$enddate.",  '%Y-%m-%d %H:%i:%s' )";
	
	$result=mysql_query($query);
	if($result== false)
	{
		die();
	}
	else
	{
		while ($row = mysql_fetch_array($result)) {
			$resourceid = $row['resource_id'];
			$start_date = $row['start_date'];
			$end_date = $row['end_date'];
			$slot = new Slots();
			$slot->start_date = $start_date;
			$slot->end_date = $end_date;
			populate_array($resourceid, $slot);
			}	
	}

}

function retrieve_blackouts($startdate, $enddate)
{
	$query = "SELECT resource_id, start_date, end_date FROM blackout_series_resources
INNER JOIN blackout_instances ON blackout_instances.blackout_series_id = blackout_series_resources.blackout_series_id
WHERE blackout_instances.start_date >= STR_TO_DATE(  ".$startdate.",  '%Y-%m-%d %H:%i:%s' )
AND blackout_instances.start_date <= STR_TO_DATE(  ".$enddate.",  '%Y-%m-%d %H:%i:%s' ) ";
	
	$result=mysql_query($query);
	if($result== false)
	{
		die();
	}
	else
	{
		while ($row = mysql_fetch_array($result)) {
			$resourceid = $row['resource_id'];
			$start_date = $row['start_date'];
			$end_date = $row['end_date'];
			$slot = new Slots();
			$slot->start_date = $start_date;
			$slot->end_date = $end_date;
			populate_array($resourceid, $slot);
		}
	}
	
}
?>
  		
 <div id="map_canvas" > 
  		 
</body>
</html>
