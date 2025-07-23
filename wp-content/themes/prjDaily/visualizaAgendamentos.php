<?php
include("conexao.php");
session_start();
echo "<!DOCTYPE html>";
echo "<html lang='pt-BR'>";
echo "<head>
        <meta charset='UTF-8'>
        <title>Visualização de Agendamentos</title>
        <link rel='stylesheet' href='style.css'>
      </head>
      <body>";

echo "<h2>Visualizar agendamentos de Perícia Médica - Segurança do Trabalho</h2>";

$sqlVisualizarAgendamentos = 
    mysqli_query($conexao, "SELECT * FROM agendamentos ORDER BY data_agendamento DESC") 
    or die("Erro ao consultar agendamentos. " . mysqli_error($conexao));

if (mysqli_num_rows($sqlVisualizarAgendamentos) > 0) {
    echo "<table class='table table-striped' border='1'>";
    echo "<thead>
            <tr>
                <th>Nome do Servidor</th>
                <th>Tipo de Usuário</th>
                <th>E-mail</th>
                <th>Tipo de Atendimento</th>
                <th>Data do Agendamento</th>
                <th>Turno</th>
                <th>Horário</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
          </thead>";
    echo "<tbody>";
    while ($row = mysqli_fetch_assoc($sqlVisualizarAgendamentos)) { 
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['nome_servidor']) . "</td>";
        echo "<td>" . htmlspecialchars($row['tipo_de_usuario']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['tipo']) . "</td>";
        echo "<td>" . htmlspecialchars($row['data_agendamento']) . "</td>";
        echo "<td>" . htmlspecialchars($row['turno']) . "</td>";
        echo "<td>" . htmlspecialchars($row['horario']) . "</td>";
        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
        echo "<td>
                <a href='editar_agendamento.php?id=" . $row['id'] . "' class='btn btn-primary'>Editar</a>
                <a href='excluir_agendamento.php?id=" . $row['id'] . "' class='btn btn-danger' onclick=\"return confirm('Tem certeza que deseja excluir este agendamento?');\">Excluir</a>
              </td>";
        echo "</tr>";
    }   
    echo "</tbody>";
    echo "</table>";    
} else {
    echo "<p>Nenhum agendamento encontrado.</p>";
}   

echo "</body></html>";
session_destroy();
?>
