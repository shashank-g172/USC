<?php 
include('connection.php');
define('ROOT_DIR', '../');
require_once(ROOT_DIR . 'Pages/ProfilePage.php');
include('calendar_try.php');


//$page =  new ProfilePage();
//$page->Display('globalheader.tpl');


$username = $_POST["username"];
$location = $_POST["location"];

if (isset($username) && $username)
{
	$query = "select user_id, scuser_name, SCAddress, city, state, zip from scprofile where SCuser_name like '%$username%'";
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
	}
	
	mysql_close($bd);
}

$length = count($usernames);
for ($i = 0; $i < $length; $i++) {
	echo '<div onmouseover="initialize(\''.$addresses[$i].'\')"><a href="calendar_try.php?sc_id='.$userids[$i].'">'.$usernames[$i].'</a></div>';
	echo "<p>" . $addresses[$i]."</p>";
}
?>

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
 <div id="map_canvas" > 
  		 
</body>
</html>
