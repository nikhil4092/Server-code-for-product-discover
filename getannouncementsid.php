<?php
error_reporting(0);
$dbhost= '208.91.198.76';
$dbname= $_POST['dbname'];
$dbuser= $_POST['dbuser'];
$dbpass= $_POST['dbpass'];
$restid= $_POST['restid'];
mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);

$q=mysql_query("SELECT * FROM Announcements WHERE `RestaurantID`='$restid' ORDER BY `ID` DESC");
while($e=mysql_fetch_assoc($q))
        $output[]=$e;

echo json_encode($output);
 
mysql_close();
?>