<?php
error_reporting(0);
$dbhost= '208.91.198.76';
$dbname= $_POST['dbname'];
$dbuser= $_POST['dbuser'];
$dbpass= $_POST['dbpass'];
$dealid = $_POST['dealid'];
$email = $_POST['emailid'];
$dat = date("Y-m-d");
mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);

$p=mysql_query("SELECT * FROM `ActivatedDeal` WHERE `EmailID`='$email' AND `DealID`='$dealid'");
$e=mysql_fetch_assoc($p);
$activationdate=$e['ActivationDate'];
$actid=$e['ActivationID'];
if($activationdate === $dat)
{
	$output[]=array("ActivationID" => $actid);
	echo json_encode($output);
}
else
{
	$output[]=array("ActivationID" => "");
	echo json_encode($output);
}


mysql_close();
?>   