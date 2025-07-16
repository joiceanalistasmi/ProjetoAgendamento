<?php

$host = 'localhost';
$user = 'root';
$password = '';
$bancoDeDados  = 'wordpress_local';

$conexao = new mysqli($host, $user, $password, $bancoDeDados);

if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}
?>