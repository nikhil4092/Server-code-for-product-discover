<?php
error_reporting(0);
session_start();
ob_start();
$dbhost = '208.91.198.76'; 
$dbname= $_POST['dbname'];
$dbuser= $_POST['dbuser'];
$dbpass= $_POST['dbpass'];

mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname); 
$q=mysql_query("SELECT DISTINCT `City` FROM `RestaurantInfo` ORDER BY `City`");
while($e=mysql_fetch_assoc($q))
        $output[]=$e;
echo json_encode($output);
mysql_close();
?>