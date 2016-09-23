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
$list = $e['Favourites'];
$myArray = explode(',', $list);
if(($key = array_search($favlist, $myArray)) !== false) {
    unset($myArray[$key]);
}
foreach($myArray as $x)
{
if($x!='')
$fav=$fav.','.$x;
}
$q=mysql_query("UPDATE User SET Favourites = '$fav' WHERE `Email`='$email'");

?>