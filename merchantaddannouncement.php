<?php
$dbhost= '208.91.198.76';
$dbname= $_POST['dbname'];
$dbuser= $_POST['dbuser'];
$dbpass= $_POST['dbpass'];
$restid= 'WAVTRAMLR';
$announcement= $_POST['announcement'];
mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);
$q=mysql_query("SELECT * FROM RestaurantInfo WHERE `RestaurantID`='$restid'");
$row = mysql_fetch_array($q);
$q=mysql_query("INSERT INTO `Announcements` (`RestaurantID`, `RestaurantName`,`Announcement`) VALUES('{$row['RestaurantID']}','{$row['RestaurantName']}','$announcement')");
?>