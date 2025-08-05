<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agendamento para perícia médica - Segurança do trabalho</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="funcao.js"></script>
    <link rel='stylesheet' href="responsive.css">
</head>

<body class="bg-light py-5">
    <header>
        <img src="imagens/logo1.jpg" alt="Logo">
        <div>
            <img src="imagens/prefeitura.jpg" alt="Prefeitura de São Miguel do Iguaçu">
        </div>
    </header>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4"> <i>Modo edição: 
                            agendamento para perícia médica - Segurança do trabalho</i></h2>

                        <?php
                        include("conexao.php");
                        require 'funcoesPhp.php';

                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn-gravar'])) {
                            $id = intval($_POST['id']);
                            $nome_servidor = $_POST['nome_servidor'];
                            $tipo_de_usuario = $_POST['tipo_de_usuario'];
                            $email = $_POST['email'];
                            $tipo = $_POST['tipo'];
                            $data_agendamento = $_POST['data_agendamento'];
                            $horario = $_POST['horario'];
                            $status = $_POST['status'];

                            $sqlEditar = "UPDATE agendamentos SET 
                                nome_servidor = '$nome_servidor',
                                tipo_de_usuario = '$tipo_de_usuario',
                                email = '$email',
                                tipo = '$tipo',
                                data_agendamento = '$data_agendamento', 
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
                                <form class="cadastro" action="editarAgendamento.php?id=<?php echo $id; ?>" name="formAgenda" id="formAgenda" method="POST">
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
                                        <input type="date" class="form-control" id="data_agendamento" name="data_agendamento"
                                            value="<?php echo htmlspecialchars($agendamento['data_agendamento']);  ?>" required>

                                    </div>

                                    <div class="mb-3">
                                        <label for="horario" class="form-label">Horário</label>
                                        <select id="horario" name="horario" class="form-select" required>
                                            <option value="<?php echo $agendamento['horario']; ?>" selected>
                                                <?php echo $agendamento['horario']; ?>
                                            </option>
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
    <footer>
        <p>&copy; Prefeitura de São Miguel do Iguaçu - Todos os direitos reservados.</p>
    </footer>

    <script>
        const dataInput = document.getElementById('data_agendamento');
        const horarioSelect = document.getElementById('horario');

        const horariosPorDia = {
            0: [], // Domingo - fora
            1: ["07:30", "07:40", "07:50", "08:00", "08:10", "08:20", "08:30", "08:40", "08:50", "09:00", "09:10", "09:20", "09:30", "09:40", "09:50", "10:00", "10:10", "10:20", "10:30", "10:40", "10:50", "11:00", "11:10", "11:20"],
            2: ["13:10", "13:20", "13:40", "13:50", "14:00", "14:10", "14:20", "14:30", "14:40", "14:50", "15:00", "15:10", "15:20", "15:30", "15:40", "15:50", "16:00", "16:10", "16:20", "16:30", "16:40", "16:50"],
            3: ["07:30", "07:40", "07:50", "08:00", "08:10", "08:20", "08:30", "08:40", "08:50", "09:00", "09:10", "09:20", "09:30", "09:40", "09:50", "10:00", "10:10", "10:20", "10:30", "10:40", "10:50", "11:00", "11:10", "11:20"],
            4: ["13:10", "13:20", "13:40", "13:50", "14:00", "14:10", "14:20", "14:30", "14:40", "14:50", "15:00", "15:10", "15:20", "15:30", "15:40", "15:50", "16:00", "16:10", "16:20", "16:30", "16:40", "16:50"],
            5: ["13:10", "13:20", "13:40", "13:50", "14:00", "14:10", "14:20", "14:30", "14:40", "14:50", "15:00", "15:10", "15:20", "15:30", "15:40", "15:50", "16:00", "16:10", "16:20", "16:30", "16:40", "16:50"],
            6: [] // Sábado - fora 
        };

        const horarioAtual = "<?php echo $agendamento['horario']; ?>";

        dataInput.addEventListener('change', function() {
            const [ano, mes, dia] = this.value.split('-').map(Number);
            const dataSelecionada = new Date(ano, mes - 1, dia);
            const diaSemana = dataSelecionada.getDay();  

            horarioSelect.innerHTML = '';  //clear 

            if (horariosPorDia[diaSemana] && horariosPorDia[diaSemana].length > 0) {
                horariosPorDia[diaSemana].forEach(hora => {
                    const option = document.createElement('option');
                    option.value = hora;
                    option.textContent = hora;
                    if (hora === horarioAtual) {
                        option.selected = true;
                    }
                    horarioSelect.appendChild(option);
                });
            } else {
                const option = document.createElement('option');
                option.value = '';
                option.textContent = 'Sem horários disponíveis para este dia';
                horarioSelect.appendChild(option);
            }
        });
    </script>


</body>

</html>