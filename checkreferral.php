<?php
session_start();
ob_start();
error_reporting(0);
$dbhost = '208.91.198.76'; 
$dbname= $_POST['dbname'];
$dbuser= $_POST['dbuser'];
$dbpass= $_POST['dbpass'];
mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);
$referral = mysql_real_escape_string($_POST['referral']);

$q=mysql_query("SELECT * from UserMaster WHERE MyRef='$referral'");
while($e=mysql_fetch_assoc($q))
        $output[]=$e;

echo json_encode($output);
mysql_close();
?>