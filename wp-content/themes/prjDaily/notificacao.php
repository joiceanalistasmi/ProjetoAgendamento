<?php
// https://ultramsg.com/pt/home/articles/how-to-send-message-by-whatsapp-api-using-php.php

require __DIR__ . '/vendor/autoload.php';


$token = "f9adf312-b65e-4f3e-b1e5-xxxxx"; // token real
$instance_id = "1234"; // id real da instância

$client = new UltraMsg\WhatsAppApi($token, $instance_id);


$to = "5545999542363";
$body = "Hello world";
$api = $client->sendChatMessage($to, $body);
if ($api->status == "success") {
    echo "Message sent successfully!";
} else {
    echo "Error: " . $api->message;
}

echo "<pre>";
print_r($api);
echo "</pre>";
