<?php
//excluir o agendamento na página visualizaAgendamento.php
 
function excluirAgendamento($id)
{
    include("conexao.php");
    if (isset($_GET['id'])) {

        $sqlExcluirAgendamento = mysqli_query($conexao, " delete from agendamentos where id = " . $_GET['id']);
        if ($sqlExcluirAgendamento) {
            echo "<script>alert('Agendamento excluído com sucesso!');</script>";
            //echo "<script>window.location.href='visualizaAgendamentos.php';</script>";
        } else {
            echo "<script>alert('Erro ao excluir o agendamento.');</script>";
            echo "<script>window.location.href='visualizaAgendamentos.php';</script>";
        }
    }
}
?>