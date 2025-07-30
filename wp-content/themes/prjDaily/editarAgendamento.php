<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agendamento de Exame Ocupacional</title>
    <linl rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="funcao.js"></script>
</head>

<body class="bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4"> Editar Agendamento para perícia médica - Segurança do trabalho</h2>
                        <h2 class="card-title text-center mb-4">Editar Agendamento</h2>

                        <?php
                        include("conexao.php");
                        require 'funcoesPhp.php';

                        // Processa atualização se enviado via POST
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn-gravar'])) {
                            $id = intval($_POST['id']);
                            $nome_servidor = $_POST['nome_servidor'];
                            $tipo_de_usuario = $_POST['tipo_de_usuario'];
                            $email = $_POST['email'];
                            $tipo = $_POST['tipo'];
                            $data_agendamento = $_POST['data_agendamento'];
                            $turno = $_POST['turno'];
                            $horario = $_POST['horario'];
                            $status = $_POST['status'];

                            $sqlEditar = "UPDATE agendamentos SET 
                                nome_servidor = '$nome_servidor',
                                tipo_de_usuario = '$tipo_de_usuario',
                                email = '$email',
                                tipo = '$tipo',
                                data_agendamento = '$data_agendamento',
                                turno = '$turno',
                                horario = '$horario',
                                status = '$status' 
                                WHERE id = $id";
                                //envia notificação por e-mail
                               $resultadoEmail = enviarNotificacao($nome_servidor, $tipo_de_usuario, $email, $tipo, $data_agendamento, $horario);
                            if ($resultadoEmail !== true) {
                                echo "<script>alert('Erro ao enviar e-mail: $resultadoEmail');</script>";
                            }

                            if (mysqli_query($conexao, $sqlEditar)) {
                                echo "<script>alert('Agendamento atualizado com sucesso!'); window.location.href='visualizaAgendamentos.php';</script>";
                                exit;
                            } else {
                                echo "<script>alert('Erro ao atualizar agendamento.'); window.history.back();</script>";
                                exit;
                            }
                        }

                        // Exibe o formulário de edição
                        if (isset($_GET['id'])) {
                            $id = intval($_GET['id']);
                            $sql = mysqli_query($conexao, "SELECT * FROM agendamentos WHERE id = $id");
                            if (mysqli_num_rows($sql) > 0) {
                                $agendamento = mysqli_fetch_assoc($sql);
                                ?>
                                <form action="editarAgendamento.php?id=<?php echo $id; ?>" name="formAgenda" id="formAgenda"
                                    method="POST">
                                    <input type="hidden" name="id" value="<?php echo $agendamento['id']; ?>">
                                    <div class="mb-3">
                                        <label for="nome_servidor" class="form-label">Nome do Servidor</label>
                                        <input type="text" class="form-control" id="nome_servidor" name="nome_servidor" value="<?php echo htmlspecialchars($agendamento['nome_servidor']); ?>" maxlength="100" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tipo_de_usuario" class="form-label">Tipo de Usuário</label>
                                        <select id="tipo_de_usuario" name="tipo_de_usuario" class="form-select" required>
                                            <option value="servidorPublico" <?php echo ($agendamento['tipo_de_usuario'] == 'servidorPublico') ? 'selected' : ''; ?>>Servidor público</option>
                                            <option value="acompanhante" <?php echo ($agendamento['tipo_de_usuario'] == 'acompanhante') ? 'selected' : ''; ?>>Acompanhante</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($agendamento['email']); ?>" maxlength="100" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tipo" class="form-label">Tipo de Atendimento</label>
                                        <select id="tipo" name="tipo" class="form-select" required>
                                            <option value="consulta" <?php echo ($agendamento['tipo'] == 'consulta') ? 'selected' : ''; ?>>Consulta</option>
                                            <option value="atestado" <?php echo ($agendamento['tipo'] == 'atestado') ? 'selected' : ''; ?>>Atestado</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="data_agendamento" class="form-label">Data do Agendamento</label>
                                        <input type="date" class="form-control" id="data_agendamento" name="data_agendamento" value="<?php echo htmlspecialchars($agendamento['data_agendamento']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="turno" class="form-label">Turno</label>
                                        <select id="turno" name="turno" class="form-select" required>
                                            <option value="">Selecione</option>
                                            <option value="manhã" <?php echo ($agendamento['turno'] == 'manhã') ? 'selected' : ''; ?>>Manhã</option>
                                            <option value="tarde" <?php echo ($agendamento['turno'] == 'tarde') ? 'selected' : ''; ?>>Tarde</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="horario" class="form-label">Horário</label>
                                        <select id="horario" name="horario" class="form-select" required>
                                            <?php
                                            $horarios = [
                                                'manhã' => ['07:30', '08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00'],
                                                'tarde' => ['13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30']
                                            ];
                                            if (isset($agendamento['turno']) && isset($horarios[$agendamento['turno']])) {
                                                foreach ($horarios[$agendamento['turno']] as $hora) {
                                                    echo "<option value='$hora' " . (($agendamento['horario'] == $hora) ? 'selected' : '') . ">$hora</option>";
                                                }
                                            } else {
                                                echo "<option value=''>Selecione o turno primeiro</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="status" class="form-label">Status</label>
                                        <select id="status" name="status" class="form-select" required>
                                            <option value="confirmado" <?php echo ($agendamento['status'] == 'confirmado') ? 'selected' : ''; ?>>Confirmado</option>
                                            <option value="cancelado" <?php echo ($agendamento['status'] == 'cancelado') ? 'selected' : ''; ?>>Cancelado</option>
                                            <option value="alterado" <?php echo ($agendamento['status'] == 'alterado') ? 'selected' : ''; ?>>Alterado</option>
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" name="btn-gravar" class="btn btn-primary">Atualizar</button>
                                        <button type="reset" name="btn-reset" class="btn btn-secondary">Limpar</button>
                                    </div>
                                </form>
                                <?php
                            } else {
                                echo "<p>Agendamento não encontrado.</p>";
                                exit;
                            }
                        } else {
                            echo "<p>ID do agendamento não especificado.</p>";
                            exit;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>