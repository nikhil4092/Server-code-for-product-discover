<?php
error_reporting(0);
$dbhost= '208.91.198.76';
$dbname= $_POST['dbname'];
$dbuser= $_POST['dbuser'];
$dbpass= $_POST['dbpass'];
$offset= $_POST['offset'];
$city= $_POST['city'];
$dbname= 'wavermmi_MAINDB';
$dbuser= 'wavermmi_WAVADM';
$dbpass= 'J1EnM4CUw8zS';
mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);
$q=mysql_query("SELECT * FROM Announcements ORDER BY `ID` DESC LIMIT 20 OFFSET $offset");
while($e=mysql_fetch_assoc($q)){
        $output[]=$e;
       $p=mysql_query("SELECT * FROM `RestaurantInfo` WHERE `RestaurantID`='{$e['RestaurantID']}' AND `City`='$city'");
      $f=mysql_fetch_assoc($p);
      $output[]=$f;
}
echo json_encode($output);
mysql_close();
?>