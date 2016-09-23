<?php
date_default_timezone_set("Asia/Kolkata");
$arr=array('time' => date("H:i:s"),'date' => date("Y-m-d"));
echo json_encode([$arr]);
?>
                            