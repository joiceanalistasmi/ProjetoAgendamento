<?php

include("conexao.php");

 if ( isset($_POST['nome'])  && isset($_POST['email'])  && isset($_POST['tipo'])  && isset($_POST['data_agendamento'])  &&  isset($_POST['horario'])  &&   
        isset($_POST['turno'])  && isset($_POST['status']))  {
   
    $nome = $_POST("nome");
    $email = $_POST("email");
    $tipo = $_POST("tipo");
    $data_agendamento = $_POST("data_agendamento");
    $horario = $_POST("horario");
    $turno = $_POST("turno");
    $status = $_POST("status");

    if (empty($nome) && empty($email) && empty("tipo") && empty("$data_agendamento")  && empty("$horario") &&
        empty("$turno") && empty("$status")){
            echo " <script> alert('Por favor, preencha todos os campos.');</script>";
    }
    
    //dados do banco de dados para gravar e fazer a verificação dos dados  
    $sqlGravarAgenda = mysqli_query($conexao,"insert into agendamentos(nome, email, tipo, data_agendamento, horario, turno, status)) 
        values ('$nome','$email','$tipo','$data_agendamento', '$horario', '$turno', '$status')") or die("Erro ao gravar o registro. " . mysqli_error($conexao));
    header('Location: lista.php'); // 
        }


?>  