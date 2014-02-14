<?php
function printImage($i,$matches,$cropClass,$icon){
    echo "<td class=\"style1\" style=\"width:100px;height:100px;\">";
    preg_match("/<img src=\"(.*?)\".*?>/",$matches[$i][0],$matImg);
    if(count($matImg)>0)
        echo "<div class=\"".$cropClass."\" 
    style=\"background-image: url(".$matImg[1].");\"></div>";
    else{
        echo "<span class=\"icons ".$icon."\"></span>";
    }
    echo "</td>";
}
function printName($i,$matches){
  echo "<td class=\"style1\">";
   preg_match("/<div class=\"name\">.*?<a href=.*?>(.*?)<\/a>.*?<\/div>/",$matches[$i][0],$matName);
       if(count($matName)>0){
      $matName[1]=trim($matName[1]);
      if(strlen($matName[1])>0)
        echo $matName[1];
      else
        echo "N/A";  
    }
    else{
      echo "N/A";
    }
    echo "</td>";
}
function printDetailsArtist($i,$matches){
    echo "<td class=\"style1\">";
    preg_match("/<div class=\"name\">.*?<a href=(.*?)>.*?<\/a>.*?<\/div>/",$matches[$i][0],$matDetails);
    if(count($matDetails)>0){
      $matDetails[1]=trim($matDetails[1]);
      if(strlen($matDetails[1])>0)
        echo "<a href=".$matDetails[1].">Details</a>";
      else
        echo "N/A";  
    }
    else{
      echo "N/A";
    }
    echo "</td>";
}
function printGenre($i,$matches){
    echo "<td class=\"style1\">";
    preg_match("/<div class=\"info\">(.*?)<br\/>/",$matches[$i][0],$matGenre);
    if(count($matGenre)>0){
      $matGenre[1]=trim($matGenre[1]);
      if(strlen($matGenre[1])>0)
        echo $matGenre[1];
      else
        echo "N/A";  
    }
    else{
      echo "N/A";
    }
    echo "</td>";
}
function printTitle($i,$matches){
    echo "<td class=\"style1\">";
    preg_match("/<div class=\"title\">.*?<a href=.*?>(.*?)<\/a>.*?<\/div>/",$matches[$i][0],$matTitle);
    if(count($matTitle)>0){
      $matTitle[1]=trim($matTitle[1]);
      if(strlen($matTitle[1])>0)
        echo $matTitle[1];
      else
        echo "N/A";  
    }
    else{
      echo "N/A";
    }
    echo "</td>";
}
function printSongTitle($i,$matches){
    echo "<td class=\"style1\">";
    preg_match("/<div class=\"title\">.*?<a href=.*?>(.*?)<\/a>.*?<\/div>/",$matches[$i][0],$matSongTitle);
    if(count($matSongTitle)>0){
      $matSongTitle[1]=trim($matSongTitle[1]);
      $matSongTitle[1] = str_replace("&quot;", "", $matSongTitle[1]);
      if(strlen($matSongTitle[1])>0)
        echo $matSongTitle[1];
      else
        echo "N/A";  
    }
    else{
      echo "N/A";
    }
    echo "</td>";


}
function printDetailsAlbum($i,$matches){
    echo "<td class=\"style1\">";
    preg_match("/<div class=\"title\">.*?<a href=(.*?)>.*?<\/a>.*?<\/div>/",$matches[$i][0],$matDetails);
    if(count($matDetails)>0){
      $matDetails[1]=trim($matDetails[1]);
      if(strlen($matDetails[1])>0)
        echo "<a href=".$matDetails[1].">Details</a>";
      else
        echo "N/A";  
    }
    else{
      echo "N/A";
    }
    echo "</td>";
}
function printSongLink($i,$matches){
    echo "<td class=\"style1\">";
    preg_match("/<div class=\"type\">.*?<\/div>/",$matches[$i][0],$matSong);
    if(count($matSong)>0){
     preg_match("/<a href=(.*?)>.*?<\/a>/",$matSong[0],$matSongValue);
    if(count($matSongValue)>0){
       $matSongValue[1]=trim($matSongValue[1]);
     echo "<a href=".$matSongValue[1]."><span class=\"icons icon_3\"></span></a>";
    }
    else{
      echo "<div class=\"icons icon_3\"><span class=\"text\">No Sample</span></div>";
    }
  }
  else
    echo "<div class=\"icons icon_3\"><span class=\"text\">No Sample</span></div>";

    echo "</td>";
}
function printArtist($i,$matches){
    echo "<td class=\"style1\">";
    preg_match("/<div class=\"artist\">(.*?)<\/div>/",$matches[$i][0],$matArtist);
     if(count($matArtist)<=0){
      echo "N/A";
    }
    else{
    preg_match_all("/<a href=.*?>(.*?)<\/a>/",$matArtist[0],$matArtistValues,PREG_SET_ORDER);
    for($i=0;$i<count($matArtistValues);$i++)
    {
         echo $matArtistValues[$i][1]."<br />";
    }
   if(count($matArtistValues)<=0){
    $matArtist[0]=trim($matArtist[0]);
    if($matArtist[0]==""){
     echo "N/A"; 
    }
    else{
      echo $matArtist[0];
    }
      
    }
  }
    echo "</td>";
}
function printYear($i,$matches){
  echo "<td class=\"style1\">";
      preg_match("/<div class=\"info\">.*?<br\/>(.*?)<\/div>/",$matches[$i][0],$matYear);
      if(count($matYear)>0){
        $matYear[1]=trim($matYear[1]);
        if(strlen($matYear[1])>0)
          echo $matYear[1];
        else{
          echo "N/A";
        }
      }
      else{
        echo "N/A";
      }
      echo "</td>";
}
function printPerformer($i,$matches){
    echo "<td class=\"style1\">";
    preg_match("/<span class=\"performer\">.*?<\/span>/",$matches[$i][0],$matPerform);
     if(count($matPerform)<=0){
      echo "N/A";
    }
    else{
    preg_match_all("/<a href=.*?>(.*?)<\/a>/",$matPerform[0],$matPerformValues,PREG_SET_ORDER);
    for($i=0;$i<count($matPerformValues);$i++)
    {
         echo $matPerformValues[$i][1]."<br />";
    }
   if(count($matPerformValues)<=0){
      echo "N/A";
    }
  }
    echo "</td>";
}
function printComposer($i,$matches){
    echo "<td class=\"style1\">";
    preg_match("/<div class=\"info\">.*?<\/div>/",$matches[$i][0],$matCompose);
    if(count($matCompose)<=0){
      echo "N/A";
    }
    else{
    preg_match_all("/<a href=.*?>(.*?)<\/a>/",$matCompose[0],$matComposeValues,PREG_SET_ORDER);
    for($i=0;$i<count($matComposeValues);$i++)
    {
         echo $matComposeValues[$i][1]."<br />";
    }
   if(count($matComposeValues)<=0){
      echo "N/A";
    }
  } 
    echo "</td>";
}
function printDetailsSong($i,$matches){
    echo "<td class=\"style1\">";
    preg_match("/<div class=\"title\">.*?<a href=(.*?)>.*?<\/a>.*?<\/div>/",$matches[$i][0],$matDetails);
    if(count($matDetails)>0){
         echo "<a href=".$matDetails[1].">Details</a>";
    }
    else{
      echo "N/A";
    }
    echo "</td>";
}
?>