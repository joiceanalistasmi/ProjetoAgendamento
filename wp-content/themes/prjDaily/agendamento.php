<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Agendamento para perícia médica</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <header>
    <img src="imagens/logo1.jpg" alt="Logo" class="logo">
    <div> <img src="imagens/prefeitura.jpg" alt="Prefeitura de São Miguel do Iguaçu">
    </div>
  </header>
  <div>
    <h2>Formulário de Agendamento - Agendamento para perícia médica - Segurança do trabalho</h2>

  </div>
  <section>
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
        <label for="nome_acompanhante ">Nome do Acompanhante (se houver*)</label>
        <input type="text" id="nome_acompanhante" name="nome_acompanhante" maxlength="100" />
      </div>
      <div>
        <label for="telefone">Telefone</label>
        <input type="text" id="telefone" name="telefone" maxlength="100" placeholder="(xx)xxxxxxxxx" required />
      </div>
      <div>
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" maxlength="100" />
      </div>

      <div>
        <label for="tipo_atendimento">Tipo de Atendimento</label>
        <select id="tipo_atendimento" name="tipo" required>
          <option value="consulta">Consulta</option>
          <option value="atestado">Homologação de Atestado</option>
        </select>
      </div>

      <div>
        <label for="data_agendamento">Data do Agendamento</label>
        <input type="date" id="data_agendamento" name="data_agendamento" required />
      </div>
      
        
      <div>
        <label for="horario">Horário</label>
        <select id="horario" name="horario" required>
          <script>
          while (horarioSelect.options.length > 0) {
          
            document.writeln("<option value='horario'>horarioSelect.value</option>");
          }
          </script>
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
     const diaDaSemana = document.getElementById('data_agendamento');

     if (diaDaSemana) {
         diaDaSemana.addEventListener('change', function () {
             const dataSelecionada = new Date(this.value);
             const dia = dataSelecionada.getDay();
             const horarioSelect = document.getElementById('horario');

         
             horarioSelect.innerHTML = '';
             
             if (dia === 1) {  
                 horarioSelect.innerHTML = '<option value="07:30">07:30</option><option value="07:40">07:40</option><option value="07:50">07:50</option>'
                 '<option value="08:00">08:00</option><option value="08:10">08:10</option><option value="08:20">08:20</option><option value="08:30">08:30</option>'
                 '<option value="08:40">08:40</option><option value="08:50">08:50</option><option value="09:00">09:00</option><option value="09:10">09:10</option>'
                 '<option value="09:20">09:20</option><option value="09:30">09:30</option><option value="09:40">09:40</option><option value="09:50">09:50</option>'
                 '<option value="10:00">10:00</option><option value="10:10">10:10</option><option value="10:20">10:20</option><option value="10:30">10:30</option>'
                 '<option value="10:40">10:40</option><option value="10:50">10:50</option><option value="11:00">11:00</option><option value="11:10">11:10</option>'
                 '<option value="11:20">11:20</option>';
             }else if (dia === 2) {  
                 horarioSelect.innerHTML = '<option value="13:10">13:10</option><option value="13:20">13:20</option><option value="13:40">13:40</option>'
                 '<option value="13:50">13:50</option><option value="14:00">14:00</option><option value="14:10">14:10</option><option value="14:20">14:20</option>'
                 '<option value="14:30">14:30</option><option value="14:40">14:40</option><option value="14:50">14:50</option><option value="15:00">15:00</option><option value="15:10">15:10</option>'
                 '<option value="15:20">15:20</option><option value="15:30">15:30</option><option value="15:40">15:40</option><option value="15:50">15:50</option>'
                 '<option value="16:00">16:00</option><option value="16:10">16:10</option><option value="16:20">16:20</option><option value="16:30">16:30</option>'
                 '<option value="16:40">16:40</option><option value="16:50">16:50</option>';
             } else if (dia === 3) {
                  horarioSelect.innerHTML = '<option value="07:30">07:30</option><option value="07:40">07:40</option><option value="07:50">07:50</option>'
                 '<option value="08:00">08:00</option><option value="08:10">08:10</option><option value="08:20">08:20</option><option value="08:30">08:30</option>'
                 '<option value="08:40">08:40</option><option value="08:50">08:50</option><option value="09:00">09:00</option><option value="09:10">09:10</option>'
                 '<option value="09:20">09:20</option><option value="09:30">09:30</option><option value="09:40">09:40</option><option value="09:50">09:50</option>'
                 '<option value="10:00">10:00</option><option value="10:10">10:10</option><option value="10:20">10:20</option><option value="10:30">10:30</option>'
                 '<option value="10:40">10:40</option><option value="10:50">10:50</option><option value="11:00">11:00</option><option value="11:10">11:10</option>'
                 '<option value="11:20">11:20</option>';
             } else if (dia === 4) {
                 horarioSelect.innerHTML = '<option value="13:10">13:10</option><option value="13:20">13:20</option><option value="13:40">13:40</option>'
                 '<option value="13:50">13:50</option><option value="14:00">14:00</option><option value="14:10">14:10</option><option value="14:20">14:20</option>'
                 '<option value="14:30">14:30</option><option value="14:40">14:40</option><option value="14:50">14:50</option><option value="15:00">15:00</option><option value="15:10">15:10</option>'
                 '<option value="15:20">15:20</option><option value="15:30">15:30</option><option value="15:40">15:40</option><option value="15:50">15:50</option>'
                 '<option value="16:00">16:00</option><option value="16:10">16:10</option><option value="16:20">16:20</option><option value="16:30">16:30</option>'
                 '<option value="16:40">16:40</option><option value="16:50">16:50</option>';
             } else if (dia === 5) {
                 horarioSelect.innerHTML = '<option value="13:10">13:10</option><option value="13:20">13:20</option><option value="13:40">13:40</option>'
                 '<option value="13:50">13:50</option><option value="14:00">14:00</option><option value="14:10">14:10</option><option value="14:20">14:20</option>'
                 '<option value="14:30">14:30</option><option value="14:40">14:40</option><option value="14:50">14:50</option><option value="15:00">15:00</option><option value="15:10">15:10</option>'
                 '<option value="15:20">15:20</option><option value="15:30">15:30</option><option value="15:40">15:40</option><option value="15:50">15:50</option>'
                 '<option value="16:00">16:00</option><option value="16:10">16:10</option><option value="16:20">16:20</option><option value="16:30">16:30</option>'
                 '<option value="16:40">16:40</option><option value="16:50">16:50</option>';

             }else{
                  horarioSelect.innerHTML = '<option value="">Dia Inválido</option>';
             }
         });
     }

  </script>

</body>

</html>