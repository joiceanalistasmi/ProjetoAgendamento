<?php

include("conexao.php");
session_start();
if (
    isset($_POST['nome_servidor']) && isset($_POST['email']) && isset($_POST['tipo']) && isset($_POST['tipo_de_usuario']) && 
    isset($_POST['data_agendamento']) && isset($_POST['horario']) &&
    isset($_POST['turno']) && isset($_POST['status'])
) {

    $nome_servidor = $_POST["nome_servidor"];
    $tipo = $_POST["tipo_de_usuario"];
    $email = $_POST["email"];
    $tipo = $_POST["tipo"];
    $data_agendamento = $_POST["data_agendamento"];
    $horario = $_POST["horario"];
    $turno = $_POST["turno"];
    $status = $_POST["status"];
  
    if (
        empty($nome_servidor) || empty($tipo_de_usuario) || empty($email) || empty($tipo) ||
        empty($data_agendamento) || empty($horario) ||
        empty($turno) || empty($status)
    ) {
        echo "<script>alert('Por favor, preencha todos os campos.'); window.history.back();</script>";
        exit;
    } else {
        $sqlGravarAgenda = mysqli_query($conexao,
            "INSERT INTO agendamentos (nome_servidor, tipo_de_usuario, email, tipo, data_agendamento, horario, turno, status)
            VALUES ('$nome_servidor','$tipo_de_usuario','$email','$tipo','$data_agendamento', '$horario', '$turno', '$status')"
        ) or die("Erro ao gravar o registro. " . mysqli_error($conexao));
            echo "<script>alert('Registro gravado com sucesso!');</script>";
            echo "<script>window.location.href = 'lista.php';</script>";
        exit;
    }
}else {
    echo "<script>alert('Dados não recebidos corretamente.'); window.history.back();</script>";
    exit;
    session_destroy();
}

?>
