<?php
error_reporting(0);
session_start();
ob_start();
$dbhost = '208.91.198.76'; 
$dbname= $_POST['dbname'];
$dbuser= $_POST['dbuser'];
$dbpass= $_POST['dbpass'];
$offset= $_POST['offset'];
$restaurantid= $_POST['restid'];
$emailid= $_POST['emailid'];
$city= $_POST['city'];

if($emailid=='')
$emailid="empty";
mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname); 
if($restaurantid=="")
{
$q=mysql_query("SELECT * FROM `ActiveDealDatabase` LIMIT 20 OFFSET $offset");
}
else
{
$q=mysql_query("SELECT * FROM `ActiveDealDatabase` WHERE `RestaurantID`='$restaurantid' LIMIT 20 OFFSET $offset");
}
$p=mysql_query("SELECT `UpvoteList` FROM User WHERE `Email`='$emailid'");
$f=mysql_fetch_array($p);
while($e=mysql_fetch_assoc($q))
       {
      
$list = $f['UpvoteList'];
$myArray = explode(',', $list);

if (in_array($e['DealID'],$myArray)) {
    
    $e['Bool']=true;
    }
    else {
$e['Bool']=false;
}
    

       $output[]=$e;
}

echo json_encode($output);
mysql_close();
?>