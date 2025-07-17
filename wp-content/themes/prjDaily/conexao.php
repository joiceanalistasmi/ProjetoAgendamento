<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'wordpress_local';

$conexao = new mysqli($host, $user, $password, $database);

if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

$conexao->set_charset("utf8");
?>