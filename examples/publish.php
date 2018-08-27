<?php

require("../phpMQTT.php");

$server = "m10.cloudmqtt.com";     // change if necessary
$port = 27343;                     // change if necessary
$username = "ubwwbbiw";                   // set your username
$password = "j02O9CLolohf";                   // set your password
$client_id = "phpMQTT-publisher"; // make sure this is unique for connecting to sever - you could use uniqid()

$mqtt = new phpMQTT($server, $port, $client_id);

if ($mqtt->connect(true, NULL, $username, $password)) {
	$mqtt->publish("bluerhinos/phpMQTT/examples/publishtest", "Hello World! at " . date("r"), 0);
	$mqtt->close();
} else {
    echo "Time out!\n";
}
