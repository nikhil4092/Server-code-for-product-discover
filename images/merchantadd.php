<?php
error_reporting(0);
$dbhost= '208.91.198.76';
$dbname= $_POST['dbname'];
$dbuser= $_POST['dbuser'];
$dbpass= $_POST['dbpass'];
$deal= $_POST['deal'];
$restid= 'WAVTRAMLR';
$stime= $_POST['stime'];
$etime= $_POST['etime'];
$sdate= $_POST['sdate'];
$edate= $_POST['edate'];
mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);
$q=mysql_query("SELECT * FROM RestaurantInfo WHERE `RestaurantID`='$restid'");
$row = mysql_fetch_array($q);
if(isset($_POST['ImageName'])){
$imgname = $_POST['ImageName'];
$imsrc = base64_decode($_POST['base64']);
$fp = fopen($imgname, 'w');
fwrite($fp, $imsrc);
if(fclose($fp)){
 echo "Image uploaded";
}else{
 echo "Error uploading image";
}
}
$fimgurl="http://www.waverr.in/app/images/".$imgname;
$p=mysql_query("INSERT INTO ActiveDealDatabase (`RestaurantID`, `RestaurantName`, `DealText`, `DealStartDate`, `DealEndDate`, `StartTime`, `EndTime`, `Cuisine`,`URL`) VALUES('{$row['RestaurantID']}','{$row['RestaurantName']}','$deal','$sdate','$edate','$stime','$etime','{$row['CuisineTags']}','$fimgurl')");
$query3=mysql_query("SELECT (`ID`) FROM ActiveDealDatabase ORDER BY `ID` DESC LIMIT 1") or die(mysql_error());
$id = mysql_fetch_array($query3);
$query4=mysql_query("UPDATE ActiveDealDatabase SET `dealID`='{$row['RestaurantID']}{$id['ID']}' WHERE `ID`={$id['ID']}");
?>