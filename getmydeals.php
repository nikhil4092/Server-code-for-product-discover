<?php
error_reporting(0);
session_start();
ob_start();
$dbhost = '208.91.198.76'; 
$dbname= $_POST['dbname'];
$dbuser= $_POST['dbuser'];
$dbpass= $_POST['dbpass'];
$emailid = $_POST['emailid'];
mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname); 
$q=mysql_query("SELECT * FROM `ActivatedDeal` WHERE `EmailID`='$emailid'");

while($e=mysql_fetch_assoc($q))
       { 
       $dealid=$e['DealID'];
       $p=mysql_query("SELECT * FROM `ActiveDealDatabase` WHERE `DealID`='$dealid'");
       $f=mysql_fetch_assoc($p);
       $f['ActivationTime']=$e['ActivationTime'];
       $f['ActivationDate']=$e['ActivationDate'];
       $f['ActivationID']=$e['ActivationID'];
       $f['City']=$e['City'];
       $q=mysql_query("SELECT `UpvoteList` FROM User WHERE `Email`='$emailid'");
       $g=mysql_fetch_array($q);
       $list = $g['UpvoteList'];
	$myArray = explode(',', $list);

	if (in_array($e['DealID'],$myArray)) {
    
 	   $f['Bool']=true;
  	  }
	    else {
	$f['Bool']=false;
	}
       $output[]=$f;
       }
echo json_encode($output);
mysql_close();
?>