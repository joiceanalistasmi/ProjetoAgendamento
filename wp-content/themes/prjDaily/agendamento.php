<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Agendamento para perícia médica</title>
  <link rel="stylesheet" href="style.css" />

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="funcao.js"></script>
  <link rel='stylesheet' href="responsive.css">
</head>

<body>
  <header>
    <img src="imagens/logo1.jpg" alt="Logo" class="logo">
    <div>
      <img src="imagens/prefeitura.jpg" alt="Prefeitura de São Miguel do Iguaçu">
    </div>
  </header>

  <div>
    <h2>Formulário de Agendamento - Perícia médica - Segurança do trabalho</h2>
  </div>

  <section> 
    <form class="cadastro" action="processar_agendamento.php" name="formAgenda" id="formAgenda" method="POST"
      onsubmit="return validarCampos(document.formAgenda);">
      <div>
        <label for="nome_servidor">Nome do Servidor*</label>
        <input type="text" id="nome_servidor" name="nome_servidor" maxlength="100" required />
      </div>

      <div>
        <label for="tipo_usuario">Tipo de Usuário*</label>
        <select id="tipo_usuario" name="tipo_de_usuario" required>
          <option value="servidorPublico">Servidor público</option>
          <option value="acompanhante">Acompanhante</option>
        </select>
      </div>

      <div>
        <label for="nome_acompanhante">Nome do Acompanhante (se houver)</label>
        <input type="text" id="nome_acompanhante" name="nome_acompanhante" maxlength="100" />
      </div>

      <div>
        <label for="telefone">Telefone*</label>
        <input type="text" id="telefone" name="telefone" maxlength="100" placeholder="(xx)xxxxx-xxxx" required />
      </div>
      <script>
       
      </script>
      <div>
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" maxlength="100" />
      </div>

      <div>
        <label for="tipo_atendimento">Tipo de Atendimento*</label>
        <select id="tipo_atendimento" name="tipo" required>
          <option value="consulta">Consulta</option>
          <option value="atestado">Homologação de Atestado</option>
        </select>
      </div>

      <div>
        <label for="data_agendamento">Data do Agendamento*</label>
        <input type="date" id="data_agendamento" name="data_agendamento" required />
      </div>

      <div>
        <label for="horario">Horário</label>
        <select id="horario" name="horario" required>
          <option value="">Selecione uma data primeiro</option>
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
        <button type="submit">AGENDAR</button>
        <button type="reset">LIMPAR</button>
      </div>
    </form>
  </section>

  <footer>
    <p>&copy; Prefeitura de São Miguel do Iguaçu - Todos os direitos reservados.</p>
  </footer>


  <script>
    const dataInput = document.getElementById('data_agendamento');
    const horarioSelect = document.getElementById('horario');

    const horariosPorDia = { /* aqui refere-se aos dias da semana */ 
      0: ['Domingo'],
      1: ["07:30", "07:40", "07:50", "08:00", "08:10", "08:20", "08:30", "08:40", "08:50", "09:00", "09:10", "09:20", "09:30", "09:40", "09:50", "10:00", "10:10", "10:20", "10:30", "10:40", "10:50", "11:00", "11:10", "11:20"], // Segunda
      2: ["13:10", "13:20", "13:40", "13:50", "14:00", "14:10", "14:20", "14:30", "14:40", "14:50", "15:00", "15:10", "15:20", "15:30", "15:40", "15:50", "16:00", "16:10", "16:20", "16:30", "16:40", "16:50"], // Terça
      3: ["07:30", "07:40", "07:50", "08:00", "08:10", "08:20", "08:30", "08:40", "08:50", "09:00", "09:10", "09:20", "09:30", "09:40", "09:50", "10:00", "10:10", "10:20", "10:30", "10:40", "10:50", "11:00", "11:10", "11:20"], // Quarta
      4: ["13:10", "13:20", "13:40", "13:50", "14:00", "14:10", "14:20", "14:30", "14:40", "14:50", "15:00", "15:10", "15:20", "15:30", "15:40", "15:50", "16:00", "16:10", "16:20", "16:30", "16:40", "16:50"], // Quinta
      5: ["13:10", "13:20", "13:40", "13:50", "14:00", "14:10", "14:20", "14:30", "14:40", "14:50", "15:00", "15:10", "15:20", "15:30", "15:40", "15:50", "16:00", "16:10", "16:20", "16:30", "16:40", "16:50"] ,
      6: ['Sábado'] 
    };

    dataInput.addEventListener('change', function () {
      const [ano, mes, dia] = this.value.split('-').map(Number);
      const dataSelecionada = new Date(ano, mes - 1, dia);
      console.log(dataSelecionada);
      const diaSemana = dataSelecionada.getDay();  
    
    //  const diaSemana = diaSemana[dataSelecionada.getDay()]; 
     // const hoje = new Date();
     //const diasDaSemana = ["domingo", "segunda", "terça", "quarta", "quinta", "sexta", "sábado"];
 // const diaDaSemana = diasDaSemana[hoje.getDay()];

    
      horarioSelect.innerHTML = ''; //limpa campo

      if (horariosPorDia[diaSemana]) {
        horariosPorDia[diaSemana].forEach(hora => {
          const option = document.createElement('option');
          option.value = hora;
          option.textContent = hora;
          horarioSelect.appendChild(option);
          horario = hora;
          console.log("Horário selecionado: " + horario);
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
