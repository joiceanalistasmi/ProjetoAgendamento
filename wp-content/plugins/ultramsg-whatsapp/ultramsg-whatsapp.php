 <?php
/*
Plugin Name: UltraMsg WhatsApp Sender
Description: Envia mensagens do WordPress usando a API UltraMsg
Version: 1.0
Author: Joice
*/

require_once __DIR__ . '/../../vendor/autoload.php'; 

use UltraMsg\WhatsAppApi;

// Apenas para teste: envia ao visitar o site
add_action('wp_loaded', function () {

    $token = "SEU_TOKEN_REAL_AQUI";
    $instance_id = "1234"; // somente o número (sem "instance")

    $client = new WhatsAppApi($token, $instance_id);

    $to = "5545999542363"; // formato: 55 + DDD + número (sem + ou espaços)
    $body = "Mensagem enviada do WordPress com UltraMsg!";

    $resposta = $client->sendChatMessage($to, $body);

    echo "<pre>";
    print_r($resposta);
    echo "</pre>";
});
