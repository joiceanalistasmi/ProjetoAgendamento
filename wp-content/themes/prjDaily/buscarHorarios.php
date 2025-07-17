<?php
include("conexao.php");

//buscar os dados do banco de dados
if (isset($_POST['buscar'])) {      
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $tipo = $_POST['tipo'];
    $data_agendamento = $_POST['data_agendamento'];
    $horario = $_POST['horario'];
    $turno = $_POST['turno'];
    $status = $_POST['status'];

    // Verifica se os campos estão preenchidos
    if (empty($nome) || empty($email) || empty($tipo) || empty($data_agendamento) || empty($horario) || empty($turno) || empty($status)) {
        echo "<script>alert('Por favor, preencha todos os campos.');</script>";
    } else {
        // Consulta ao banco de dados
        $sqlBuscarHorarios = mysqli_query($conexao, "SELECT * FROM agendamentos WHERE nome LIKE '%$nome%' AND email LIKE '%$email%' AND tipo LIKE '%$tipo%' AND data_agendamento='$data_agendamento' AND horario='$horario' AND turno='$turno' AND status='$status'")
            or die("Erro ao buscar os registros. " . mysqli_error($conexao));

        // Exibir resultados
        while ($row = mysqli_fetch_assoc($sqlBuscarHorarios)) {
            echo "Nome: " . $row['nome'] . "<br>";
            echo "Email: " . $row['email'] . "<br>";
            echo "Tipo: " . $row['tipo'] . "<br>";
            echo "Data do Agendamento: " . $row['data_agendamento'] . "<br>";
            echo "Horário: " . $row['horario'] . "<br>";
            echo "Turno: " . $row['turno'] . "<br>";
            echo "Status: " . $row['status'] . "<br><hr>";
        }
    }
}

?>