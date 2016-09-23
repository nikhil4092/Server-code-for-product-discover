<?php
error_reporting(0);
$dbhost= '208.91.198.76';
$dbname= $_POST['dbname'];
$dbuser= $_POST['dbuser'];
$dbpass= $_POST['dbpass'];
$dealid = $_POST['dealid'];
$city = $_POST['city'];
$emailid = $_POST['emailid'];
$tim = date("H:i:s");
$dat = date("Y-m-d");

mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);
$q=mysql_query("SELECT * FROM User WHERE `Email`='$emailid'");
$s=mysql_fetch_array($q);
$r=mysql_query("SELECT * FROM ActiveDealDatabase WHERE `DealID`='$dealid'");
$t=mysql_fetch_array($r);
$restid=$t['RestaurantID'];
$restname=$t['RestaurantName'];
$name=$s['Name'];
$p=mysql_query("INSERT INTO ActivatedDeal (`DealID`,`RestaurantID`,`RestaurantName`,`City`,`EmailID`,`CustomerName`,`ActivationTime`,`ActivationDate`,`ActivationID`) VALUES('$dealid','$restid','$restname','$city','$emailid','$name','$tim','$dat','')");
$a=mysql_query("SELECT * FROM ActivatedDeal ORDER BY `ID` DESC LIMIT 1");
$b = mysql_fetch_array($a);
$id= $b['ID'];
$idi=(int)$id;
$ids= dechex($idi+993289);
$activationid=$dealid.'-'.$ids;

$c=mysql_query("UPDATE `ActivatedDeal` SET `ActivationID`='$activationid' WHERE `ID`={$b['ID']}");
$output[]=array("ActivationID" => $activationid);
echo json_encode($output);
mysql_close();
?>