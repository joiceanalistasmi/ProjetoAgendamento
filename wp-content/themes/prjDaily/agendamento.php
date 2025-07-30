<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Agendamento de Exame Ocupacional</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <header>
    <img src="imagens/logo1.jpg" alt="Logo" class="logo">
    <div> <img src="imagens/prefeitura.jpg" alt="Prefeitura de São Miguel do Iguaçu">
    </div>
  </header>
  <div>
    <h2>Agendamento para perícia médica - Segurança do trabalho</h2>
    <h2>Formulário de Agendamento</h2>
</div>
    <form class="cadastro" action="processar_agendamento.php" name="formAgenda" id="formAgenda" method="POST" onsubmit="return validarCampos(document.formAgenda);">
      <div>
        <label for="nome_servidor">Nome do Servidor</label>
        <input type="text" id="nome_servidor" name="nome_servidor" maxlength="100" required />
      </div>

      <div>
        <label for="tipo_usuario">Tipo de Usuário</label>
        <select id="tipo_usuario" name="tipo_de_usuario" required>
          <option value="servidorPublico">Servidor público</option>
          <option value="acompanhante">Acompanhante</option>
        </select>
      </div>

      <div>
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" maxlength="100" required />
      </div>

      <div>
        <label for="tipo_atendimento">Tipo de Atendimento</label>
        <select id="tipo_atendimento" name="tipo" required>
          <option value="consulta">Consulta</option>
          <option value="atestado">Atestado</option>
        </select>
      </div>

      <div>
        <label for="data_agendamento">Data do Agendamento</label>
        <input type="date" id="data_agendamento" name="data_agendamento" required />
      </div>

      <div>
        <label for="turno">Turno</label>
        <select id="turno" name="turno" required>
          <option value="">Selecione</option>
          <option value="manhã">Manhã</option>
          <option value="tarde">Tarde</option>
        </select>
      </div>

      <div>
        <label for="horario">Horário</label>
        <select id="horario" name="horario" required>
          <option value="">Selecione o turno primeiro</option>
        </select>
      </div>

      <div>
        <label for="status">Status</label>
        <select id="status" name="status" required>
          <option value="confirmado" selected>Confirmado</option>
          <option value="cancelado">Cancelado</option>
          <option value="alterado">Alterado</option>
        </select>
      </div>

      <div class="button">
        <button type="submit">Agendar</button>
        <button type="reset">Limpar</button>
      </div>
    </form>
<footer>
    <p>&copy; Prefeitura de São Miguel do Iguaçu - Todos os direitos reservados.</p>
</footer>

  <script>
    const horariosPorTurno = {
      manhã: ['07:30', '08:00', '08:30', '09:00', '09:30', '10:00', '10:30', '11:00'],
      tarde: ['13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30']
    };

    document.getElementById('turno').addEventListener('change', function() {
      const turno = this.value;
      const horarioSelect = document.getElementById('horario');

      // Limpa opções anteriores
      horarioSelect.innerHTML = '';

      if (turno && horariosPorTurno[turno]) {
        horariosPorTurno[turno].forEach(hora => {
          const option = document.createElement('option');
          option.value = hora;
          option.textContent = hora;
          horarioSelect.appendChild(option);
        });
      } else {
        const option = document.createElement('option');
        option.value = '';
        option.textContent = '-- Selecione o turno primeiro --';
        horarioSelect.appendChild(option);
      }
    });
  </script>
</body>

</html>