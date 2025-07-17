<?php

include("conexao.php");

if (
    isset($_POST['nome_servidor']) && isset($_POST['email']) && isset($_POST['tipo']) &&
    isset($_POST['data_agendamento']) && isset($_POST['horario']) &&
    isset($_POST['turno']) && isset($_POST['status'])
) {

    $nome_servidor = $_POST["nome_servidor"];
    $email = $_POST["email"];
    $tipo = $_POST["tipo"];
    $data_agendamento = $_POST["data_agendamento"];
    $horario = $_POST["horario"];
    $turno = $_POST["turno"];
    $status = $_POST["status"];

    if (
        empty($nome_servidor) || empty($email) || empty($tipo) ||
        empty($data_agendamento) || empty($horario) ||
        empty($turno) || empty($status)
    ) {
        echo "<script>alert('Por favor, preencha todos os campos.'); window.history.back();</script>";
        exit;
    } else {
        $sqlGravarAgenda = mysqli_query($conexao,
            "INSERT INTO agendamentos (nome_servidor, email, tipo, data_agendamento, horario, turno, status)
            VALUES ('$nome_servidor','$email','$tipo','$data_agendamento', '$horario', '$turno', '$status')"
        ) or die("Erro ao gravar o registro. " . mysqli_error($conexao));

        header('Location: lista.php');
        exit;
    }
}else {
    echo "<script>alert('Dados não recebidos corretamente.'); window.history.back();</script>";
    exit;
}

?>
