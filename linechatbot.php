[code] <?php
require(“vendor/autoload.php”);
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;

require(“phpMQTT.php”);

$mqtt = new phpMQTT(“m10.cloudmqtt.com”, 27343, “/label”); //เปลี่ยน www.yourmqttserver.com ไปที่ mqtt server ที่เราสมัครไว้นะครับ

$token = “iGDxZmG08RKEvQYAvVsWEHXUiVpi1oQTrtgJntiKIz/Oxd7WFbEHNhc8YP6acrHlc9lKFGBkXc4vE/tv97bjigKMgqkAYLffV7qULxM24BmWHZmmd72KO5KOxW5wKhwwv3hQ1j5OSEJd/MPHJ+khDgdB04t89/1O/w1cDnyilFU=”; //นำ token ที่มาจาก line developer account ของเรามาใส่ครับ

$httpClient = new CurlHTTPClient($token);
$bot = new LINEBot($httpClient, [‘channelSecret’ => $token]);
// webhook
$jsonStr = file_get_contents(‘php://input’);
$jsonObj = json_decode($jsonStr);
print_r($jsonStr);
foreach ($jsonObj->events as $event) {
if(‘message’ == $event->type){
// debug
//file_put_contents(“message.json”, json_encode($event));
$text = $event->message->text;

if (preg_match(“/Ph/”, $text)) and preg_match(“/PH/”, $text)) {     //หากในแชตที่ส่งมามีคำว่า เปิดทีวี ก็ให้ส่ง mqtt ไปแจ้ง server เราครับ
if ($mqtt->connect()) {
$mqtt->publish(“label”,”$text”); // ตัวอย่างคำสั่งเปิดทีวีที่จะส่งไปยัง mqtt server
$mqtt->close();
}
$text = “เปลี่ยนค่า PH ให้แล้วครับ”;
}

if (preg_match(“/Cl/”, $text) and preg_match(“/CL/”, $text)) {
if ($mqtt->connect()) {
$mqtt->publish(“label”,”$text”);
$mqtt->close();
}
$text = “เปลี่ยนค่าคลอลีนให้แล้วครับ”;
}

if (preg_match(“/Tu/”, $text) and preg_match(“/TU/”, $text)) {
if ($mqtt->connect()) {
$mqtt->publish(“label”,”$text”);
$mqtt->close();
}
$text = “เปลี่ยนค่าความขุ่นให้แล้วครับ”;
}

$response = $bot->replyText($event->replyToken, $text); // ส่งคำ reply กลับไปยัง line application

}
}

?>
[/code]
