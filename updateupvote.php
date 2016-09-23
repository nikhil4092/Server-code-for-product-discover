<?php
error_reporting(0);
session_start();
ob_start();
$dbhost = '208.91.198.76'; 
$dbname= $_POST['dbname'];
$dbuser= $_POST['dbuser'];
$dbpass= $_POST['dbpass'];
$newupvotelist= $_POST['newupvotelist'];
$delupvotelist= $_POST['delupvotelist'];
$email= $_POST['emailid'];

mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname);
$p=mysql_query("SELECT `UpvoteList` FROM User WHERE `Email`='$email'");
$e=mysql_fetch_array($p);
$r=mysql_query("SELECT `Upvotes` FROM `ActiveDealDatabase` WHERE `Email`='$email'");
$f=mysql_fetch_array($r);
$upvotelist=$e['UpvoteList'];
$upvotes=$f['Upvotes'];
$myArray = explode(',', $newupvotelist);
foreach($myArray as $element)
{
if($element!='')
$upvotelist=$upvotelist.','.$element;
mysql_query("UPDATE ActiveDealDatabase SET Upvotes = Upvotes + 1 WHERE `DealID`='$element'");
}
$q=mysql_query("UPDATE User SET UpvoteList = '$upvotelist' WHERE `Email`='$email'");

$flag=0;

$p=mysql_query("SELECT `UpvoteList` FROM User WHERE `Email`='$email'");
$e=mysql_fetch_array($p);
$list=explode(',',$e['UpvoteList']);
$newArray = explode(',', $delupvotelist);
foreach($list as $ele)
{

$flag=0;
foreach($newArray as $x)
{

	if($x==$ele)
	{$flag=1;break;}
}
if($flag==0 && $ele!='')
{$li=$li.','.$ele;}

}

foreach($newArray as $a)
{mysql_query("UPDATE ActiveDealDatabase SET Upvotes = Upvotes - 1 WHERE `DealID`='$a'");}
$q=mysql_query("UPDATE User SET UpvoteList = '$li' WHERE `Email`='$email'");
?>