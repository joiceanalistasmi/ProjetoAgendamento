<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

include("conexao.php");

session_start();

function enviarNotificacao($nome_servidor, $tipo_de_usuario, $email, $tipo, $data_agendamento, $horario)
{
    $mail = new PHPMailer(true);

    try {
        // conf do servidor 
        //preciso verificar pois aqui esta o meu email 
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'joice.smipm@gmail.com';
        $mail->Password   = 'jvco myeg munj budd';// senha criada pelo google 
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom($mail->Username, 'Joice');
        $mail->addAddress($email, $nome_servidor);

        // Conteúdo
        $mail->isHTML(true);
        $mail->Subject = 'Notificação da Perícia médica - Prefeitura de São Miguel do Iguaçu';
        $mail->Body    = '<strong> O ' .$nome_servidor. ' agendou um exame de Perícia médica para a data: ' . $data_agendamento . ' as ' . $horario . '</strong>';
        $mail->AltBody = ' O ' .$nome_servidor. ' agendou um exame de Perícia médica para a ' . $data_agendamento . ' as ' . $horario;
        
        $mail->SMTPDebug = 2; 
        $mail->Debugoutput = 'html';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Erro ao enviar e-mail: {$mail->ErrorInfo}";
    }
}

if (
    isset($_POST['nome_servidor']) && isset($_POST['email']) && isset($_POST['tipo']) && isset($_POST['tipo_de_usuario']) &&
    isset($_POST['data_agendamento']) && isset($_POST['horario']) &&
    isset($_POST['turno']) && isset($_POST['status'])
) {

    $nome_servidor = $_POST["nome_servidor"];
    $tipo_de_usuario = $_POST["tipo_de_usuario"];
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
        $sqlconsultahoraDisponivel =
            mysqli_query(
                $conexao,
                "SELECT * FROM agendamentos WHERE horario = '$horario' AND data_agendamento = '$data_agendamento'"
            ) or die("Erro ao consultar horários disponíveis. " . mysqli_error($conexao));

        if (mysqli_num_rows($sqlconsultahoraDisponivel) > 0) {
            echo "<script>alert('Horário já agendado. Por favor, escolha outro horário.'); window.history.back();</script>";
            exit;
        } else {
            $sqlGravarAgenda = mysqli_query(
                $conexao,
                "INSERT INTO agendamentos (nome_servidor, tipo_de_usuario, email, tipo, data_agendamento, horario, turno, status)
                VALUES ('$nome_servidor','$tipo_de_usuario','$email','$tipo','$data_agendamento', '$horario', '$turno', '$status')"
            ) or die("Erro ao gravar o registro. " . mysqli_error($conexao));

            // Envia o e-mail
            $resultadoEmail = enviarNotificacao($nome_servidor, $tipo_de_usuario, $email, $tipo, $data_agendamento, $horario);
            if ($resultadoEmail === true) {
                echo "<script>alert('Registro gravado e e-mail enviado com sucesso!'); window.location.href = 'https://saomiguel.pr.gov.br/';</script>";
            } else {
                echo "<script>alert('Registro gravado, m
                
                '); window.location.href = 'agendamento.php';</script>";
            }
            exit;
        }
    }
} else {
    echo "<script>alert('Dados não recebidos corretamente.'); window.history.back();</script>";
    exit;
    session_destroy();
}

//verificar se horario esta disponivel para o agendamento, pois o horario pode estar ocupado por outro servidor
/*

*/

//enviar a notitificação por e-mail
include("notificacaoAgenda.php");
$sqlnotificaUsuaruio = mysqli_query(
    $conexao,
    "INSERT INTO notificacoes (agendamento_id, tipo, data_envio) VALUES ('$id', '$tipo', NOW())"
);
