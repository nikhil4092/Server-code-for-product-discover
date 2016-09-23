<?php
session_start();
ob_start();
error_reporting(0);
$dbhost = '208.91.198.76'; 
$dbname= $_POST['dbname'];
$dbuser= $_POST['dbuser'];
$dbpass= $_POST['dbpass'];
$name = $_POST['name'];
$email = $_POST['email'];
$age = $_POST['age'];
$sentref= $_POST['referral'];
$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
$length=strlen($characters)-1;
$referralcode = '';
 for ($i = 0; $i < 6; $i++) {
      $referralcode .= $characters[rand(0,$length)];
 }
mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);                  
$query = "INSERT INTO User VALUES('$email','$name','$age','$referralcode','$sentref','','0','','')";
queryMysql($query);

function queryMysql($query)
{
$result = mysql_query($query) or die(mysql_error());
}

mysql_close();
?>