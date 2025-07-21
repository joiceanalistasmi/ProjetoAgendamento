<?php
//https://ultramsg.com/pt/home/articles/how-to-send-message-by-whatsapp-api-using-php.php

require_once ('vendor/autoload.php'); // if you use Composer
//require_once('ultramsg.class.php'); // if you download ultramsg.class.php
	
$token="tof7lsdJasdloaa57e"; // Ultramsg.com token
$instance_id="instance1150"; // Ultramsg.com instance id
$client = new UltraMsg\WhatsAppApi($token,$instance_id);
	
$to="put_your_mobile_number_here"; 
$body="Hello world"; 
$api=$client->sendChatMessage($to,$body);
print_r($api);

?>
 