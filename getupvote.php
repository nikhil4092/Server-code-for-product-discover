<?php
error_reporting(0);
session_start();
ob_start();
$dbhost = '208.91.198.76'; 
$dbname= $_POST['dbname'];
$dbuser= $_POST['dbuser'];
$dbpass= $_POST['dbpass'];
$email= $_POST['email'];
mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname); 
$q=mysql_query("SELECT `UpvoteList` FROM User WHERE `Email`='$email'");
while($e=mysql_fetch_assoc($q))
        $output[]=$e;
echo json_encode($output);
mysql_close();
?>