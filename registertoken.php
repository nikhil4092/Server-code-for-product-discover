<?php
error_reporting(0);
session_start();
ob_start();
$dbhost = '208.91.198.76'; 
$dbname= $_POST['dbname'];
$dbuser= $_POST['dbuser'];
$dbpass= $_POST['dbpass'];
$email= $_POST['emailid'];
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
		
		$pushMessage = $_POST["message"];	
		$message = array('m' => $pushMessage);	
		$pushStatus = sendPushNotificationToGCM($gcmRegIds, $message);
				
	}
	
	//this block is to receive the GCM regId from external (mobile apps)
	if(!empty($_POST["shareregid"])) {
	
	mysql_connect($dbhost,$dbuser,$dbpass);
	mysql_select_db($dbname);
	$token = $_POST["regid"];
	if($email!='')
	{
	$q=mysql_query("UPDATE User SET Token = '$token' WHERE `Email`='$email'");
	}
	else
	{
	$p=mysql_query("SELECT Token FROM UnknownTokens WHERE Token = '$token'");
	$num = mysql_num_rows($p);
	if($num==0)
	$q=mysql_query("INSERT INTO UnknownTokens VALUES('$token')");
	}

		
		echo "Ok!";
		exit;
	}	
?>
<html>
    <head>
        <title>Google Cloud Messaging (GCM) Server in PHP</title>
    </head>
	<body>
		<h1>Google Cloud Messaging (GCM) Server in PHP</h1>	
		<form method="post" action="registertoken.php/?push=1">					                             
			<div>                                
				<textarea rows="2" name="message" cols="23" placeholder="Message to transmit via GCM"></textarea>
			</div>
			<div><input type="submit"  value="Send Push Notification via GCM" /></div>
		</form>
		<p><h3><?php echo $pushStatus; ?></h3></p>        
    </body>
</html>