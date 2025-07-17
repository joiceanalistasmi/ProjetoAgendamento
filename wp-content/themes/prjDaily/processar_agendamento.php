<?php
include("conexao.php");

    $nome = $_POST("nome");
    $email = $_POST("email");
    $tipo = $_POST("tipo");
    $data_agendamento = $_POST("data_agendamento");
    $horario = $_POST("horario");
    $turno = $_POST("turno");
    $status = $_POST("status");

    if (empty($nome) && empty($email) && empty("tipo") && empty("$data_agendamento")  && empty("$horario") &&
        empty("$turno") && empty("$status")){
            echo " <script> alert('por favor, preencha todos os campos.');</script>";
    }

?>  