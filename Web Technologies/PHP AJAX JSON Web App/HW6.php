<html>
<head>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<!--<script src="http://mediaplayer.yahoo.com/js"></script>-->
</head>
<body>

<?php
require 'HW6_util.php';

header('Content-Type: text/html; charset=UTF-8');
set_error_handler(
    create_function(
        '$severity, $message, $file, $line',
        'throw new ErrorException($message, $severity, $severity, $file, $line);'
    )
);
$mainURL="http://www.allmusic.com/search/";
$artists="artists/";
$songs="songs/";
$albums="albums/";
$space="/\s+/";
if (isset($_REQUEST['search']) && isset($_REQUEST['searchType'])){
    if($_REQUEST['search']=="" || $_REQUEST['searchType']==""){
      echo "Error in input......Please Start over from the start page and enable javascript in your browser";
      exit(1);
    }
    $searchURLDisplay=urlencode($_REQUEST['search']);
    $searchURL=utf8_encode($_REQUEST['search']);
    $searchURL=urlencode($searchURL);
    $search=preg_replace($space,'+',$searchURL);
  //  $search = htmlentities($search, ENT_QUOTES, 'UTF-8');
    try{
    if($_REQUEST['searchType'] == "artists"){
      $html=file_get_contents($mainURL . $artists . $search);
      $tableExtract="/<tr class=\"search-result artist\">.*?<\/tr>/";
    }
    else if($_REQUEST['searchType'] == "songs"){
        $html=file_get_contents($mainURL . $songs . $search);
    //  $html=file_get_contents("http://www.allmusic.com/search/songs/Juan+Pe%C3%B1a");
        $tableExtract="/<tr class=\"search-result song\">.*?<\/tr>/";
    }
    else if($_REQUEST['searchType'] == "albums"){
        $html=file_get_contents($mainURL . $albums . $search);
        $tableExtract="/<tr class=\"search-result album\">.*?<\/tr>/";
    }
    else{
        echo "Error: Unknown input";
    }
  }
  catch(Exception $e){
      echo "<h1 class=\"aligncenter\">Search Result</h1>";
      echo "<b><div class=\"aligncenter\">\"".utf8_encode(urldecode(utf8_decode($searchURLDisplay)))."\"of type\"".$_REQUEST['searchType']."\"</div></b>";
      echo "<h1 class=\"aligncenter\">No discography found!</h1>";
      exit(1);
  }
    $html = str_replace("\n", "", $html);
    $html = str_replace("\r", "", $html);
    echo "<h1 class=\"aligncenter\">Search Result</h1>";
    echo "<b><div class=\"aligncenter\">\"".utf8_encode(urldecode(utf8_decode($searchURLDisplay)))."\" of type \"".$_REQUEST['searchType']."\"</div></b>";
   // $tableExtract="/<tr class=\"search-result artist\">.*?<\/tr>/";
    preg_match_all($tableExtract,$html,$matches,PREG_SET_ORDER);
    $matchNo=count($matches);
    if($matchNo==0){
       echo "<h1 class=\"aligncenter\">No discography found!</h1>";
    }
    else{
      echo "<p><table border=\"1\" align=\"center\" cellpadding=\"10\">";
       if($_REQUEST['searchType'] == "albums"){
         echo "<tr><th>Image</th><th>Title</th><th>Artist</th><th>Genre(s)</th><th>Year</th><th>Details</th></tr>";
      }
      if($_REQUEST['searchType'] == "artists"){
      echo "<tr><th>Image</th><th>Name</th><th>Genre(s)</th><th>Year(s)</th><th>Details</th></tr>";
      }
      if($_REQUEST['searchType'] == "songs"){
      echo "<tr><th>Sample</th><th>Title</th><th>Performer</th><th>Composer(s)</th><th>Details</th></tr>";
      }
    }
    if($matchNo>5){
      $matchNo=5;
    }
    if($_REQUEST['searchType'] == "artists")
    for($i=0;$i<$matchNo;$i++){
      echo "<tr>";
      printImage($i,$matches,"center-cropped","icon_1");
      printName($i,$matches);
      printGenre($i,$matches);
      printYear($i,$matches);
      printDetailsArtist($i,$matches);
      echo "</tr>";
    }
    else if($_REQUEST['searchType'] == "albums")
    for($i=0;$i<$matchNo;$i++){
      echo "<tr>";
      printImage($i,$matches,"resize","icon_2");
      printTitle($i,$matches);
      printArtist($i,$matches);
      printYear($i,$matches);
      printGenre($i,$matches);
      printDetailsAlbum($i,$matches);
      echo "</tr>";
    }
    else if($_REQUEST['searchType'] == "songs")
    for($i=0;$i<$matchNo;$i++){
      echo "<tr>";
      printSongLink($i,$matches);
      printSongTitle($i,$matches);
      printPerformer($i,$matches);
      printComposer($i,$matches);
      printDetailsSong($i,$matches);
      echo "</tr>";
    }
    echo "</table>";
  }
else{
  echo "Error in input......Please Start over from the start page and enable javascript in your browser";
  }
?>
</body>
</html>