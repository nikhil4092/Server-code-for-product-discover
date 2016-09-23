<?php
error_reporting(0);
session_start();
ob_start();
$dbhost = '208.91.198.76'; 
$dbname= 'wavermmi_MAINDB';
$dbuser= 'wavermmi_WAVADM';
$dbpass= 'J1EnM4CUw8zS';
	//generic php function to send GCM push notification
   function sendPushNotificationToGCM($registatoin_ids, $message) {
		//Google cloud messaging GCM-API url
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
        );
        echo json_encode($fields);
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
        return $result;
    }
?>
<?php
	
	//this block is to post message to GCM on-click
	$pushStatus = "";	
	if(!empty($_GET["push"])) {	
		
		mysql_connect($dbhost,$dbuser,$dbpass);
		mysql_select_db($dbname);
		$a=mysql_query("SELECT * FROM `User`");
		while($e=mysql_fetch_array($a)){
		$gcmRegIds[]=$e['Token'];
		}
		
		$pushMessage = $_POST["Message"];
		$title = $_POST['Title'];
		$URL = $_POST['URL'];
		$other = $_POST['Other'];
		$message = array('Message' => $pushMessage,'Title' => $title,'URL' => $URL,'Other' => $other);	
		if($_POST['Password']=="Waverr" || $pushMessage!='' || $title!='')
		$pushStatus = sendPushNotificationToGCM($gcmRegIds, $message);
		else
		echo "Incorrect password or Missing field";
				
	}
?>
<html>
    <head>
        <title>Google Cloud Messaging (GCM) Server in PHP</title>
    </head>
	<body>
		<h1>Google Cloud Messaging (GCM) Server in PHP</h1>	
		<form method="post" action="sendnotifications.php/?push=1">					                             
			<div>     Title*:                          
				<input type="Text" rows="3" name="Title"  placeholder=""></input>
			</div>
			<div>   <br> Message*:                            
				<input type="Text" rows="3" name="Message"  placeholder=""></input>
			</div>
			<div>   <br> URL:                            
				<input type="Text" rows="3" name="URL" placeholder=""></input>
			</div>
			<div>   <br> Other:                            
				<input type="Text" rows="3" name="Other" placeholder=""></input>
			</div>
			<div>   <br> Password                            
				<input type="password" rows="3" name="Password" placeholder=""></input>
			</div><br>
			<div><input type="submit"  value="Send Push Notification via GCM" /></div>
		</form>
		<p><h3><?php echo $pushStatus;?></h3></p>        
    </body>
</html>