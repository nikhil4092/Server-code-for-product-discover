<?php
error_reporting(0);
$dbhost= '208.91.198.76';
$dbname= $_POST['dbname'];
$dbuser= $_POST['dbuser'];
$dbpass= $_POST['dbpass'];
$email= $_POST['email'];
$sentref= $_POST['referral'];
mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);

$p=mysql_query("SELECT 1 FROM `User` WHERE `Email`='$email'");
if($p && mysql_num_rows($p)>0)
{return null;}
else
	{
	$s=mysql_query("Select * FROM `User` WHERE `ReferralCode`='$sentref'");
	if(!empty($s))
	{
	   while($e=mysql_fetch_assoc($s))
           $output[]=$e;
 
	   echo json_encode($output);
	}
	else
	{return null;}
      } 
       



mysql_close();
?>                                
                  