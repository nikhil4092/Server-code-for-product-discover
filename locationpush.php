<?php
error_reporting(0);
session_start();
ob_start();
$dbhost = '208.91.198.76'; 
$dbname= $_POST['dbname'];
$dbuser= $_POST['dbuser'];
$dbpass= $_POST['dbpass'];
$emailid = $_POST['emailid'];
$lat = $_POST['latitude'];
$long = $_POST['longitude'];
	//generic php function to send GCM push notification
   function sendPushNotificationToGCM($registatoin_ids, $message) {
		//Google cloud messaging GCM-API url
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
        );
        
	// Google Cloud Messaging GCM API Key
		define("GOOGLE_API_KEY", "AIzaSyAroAxFY-YW7uc91HHmn67XLuBa3k0i_es"); 		
        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);				
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return json_encode(array("this"=>"hi"));
    }

	
	//this block is to post message to GCM on-click
	$pushStatus = "";	
		
		mysql_connect($dbhost,$dbuser,$dbpass);
		mysql_select_db($dbname);
		$a=mysql_query("SELECT * FROM `User` WHERE `Email`='$emailid'");
		while($e=mysql_fetch_array($a)){
		$gcmRegIds[]=$e['Token'];
		}
		
		$pushMessage = "latitude:".$lat.",longitude".$long;
		$title = "Waverr Welcomes you to this location";
		$URL = $_POST['URL'];
		$other = "latitude:".$lat.",longitude".$long;
		$message = array('Message' => $pushMessage,'Title' => $title,'URL' => $URL,'Other' => $other);	
		$pushStatus = sendPushNotificationToGCM($gcmRegIds, $message);
		
				
	
?>