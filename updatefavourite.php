<?php
error_reporting(0);
session_start();
ob_start();
$dbhost = '208.91.198.76'; 
$dbname= $_POST['dbname'];
$dbuser= $_POST['dbuser'];
$dbpass= $_POST['dbpass'];
$favlist= $_POST['favourite'];
$email= $_POST['emailid'];

mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);
$p=mysql_query("SELECT `Favourites` FROM User WHERE `Email`='$email'");
$e=mysql_fetch_array($p);
$fav=$e['Favourites'].','.$favlist;

$q=mysql_query("UPDATE User SET Favourites = '$fav' WHERE `Email`='$email'");

?>