<?php
include("conexao.php");
echo "<html>
      <head>
          <title>Listar Horários</title>
          <meta charset='utf-8'>
      </head>
      <body>";
// conforme a data informada listar os horarios 
echo "<h1>Listar os horários:</h1>";

$sqlBuscarHorarios = mysqli_query($conexao, "SELECT * FROM horarios_disponiveis ORDER BY turno")
    or die("Erro ao buscar os registros. " . mysqli_error($conexao));

echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Horário</th><th>Turno</th></tr>";

while ($dados = mysqli_fetch_assoc($sqlBuscarHorarios)) {
    $horario = $dados["horario"];
    $turno = $dados["turno"];
    echo "<tr>
            <td>$horario</td>
            <td>$turno</td>
          </tr>";
}

echo "</table>";
echo "</body>
      </html>";
?>