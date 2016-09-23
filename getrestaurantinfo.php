<?php
error_reporting(0);
session_start();
ob_start();
$dbhost = '208.91.198.76'; 
$dbname= $_POST['dbname'];
$dbuser= $_POST['dbuser'];
$dbpass= $_POST['dbpass'];
$restid= $_POST['restid'];
$emailid= $_POST['emailid'];

mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname); 
$q=mysql_query("SELECT * FROM `RestaurantInfo` WHERE `RestaurantID`='$restid'");
$p=mysql_query("SELECT `Favourites` FROM User WHERE `Email`='$emailid'");
$f=mysql_fetch_array($p);
while($e=mysql_fetch_assoc($q))
{
$list = $f['Favourites'];
$myArray = explode(',', $list);

if (in_array($restid,$myArray)) {
    
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