<?php
require("../phpMQTT.php");
$server = "m10.cloudmqtt.com";     // change if necessary
$port = 	27343;                     // change if necessary
$username = "ubwwbbiw";                   // set your username
$password = "j02O9CLolohf";                   // set your password
$client_id = "phpMQTT-subscriber"; // make sure this is unique for connecting to sever - you could use uniqid()
$mqtt = new phpMQTT($server, $port, $client_id);
if(!$mqtt->connect(true, NULL, $username, $password)) {
	exit(1);
}
$topics['te66179/phpMQTT/label'] = array("qos" => 0, "function" => "procmsg");
$mqtt->subscribe($topics, 0);
while($mqtt->proc()){
		
}
$mqtt->close();
function procmsg($topic, $msg){
		echo "Msg Recieved: " . date("r") . "\n";
		echo "Topic: {$topic}\n\n";
		echo "\t$msg\n\n";
}
