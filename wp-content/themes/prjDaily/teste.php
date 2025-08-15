 <?php
include("conexao.php");
session_start();
date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Visualização de Agendamentos</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .modal {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            display: none;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            width: 500px;
            border-radius: 5px;
            position: relative;
        }

        .close {
            position: absolute;
            top: 10px; right: 10px;
            cursor: pointer;
            font-size: 20px;
        }
    </style>
</head>
<body>

<header>
    <img src="imagens/logo1.jpg" alt="Logo" class="logo">
    <div>
        <img src="imagens/prefeitura.jpg" alt="Prefeitura de São Miguel do Iguaçu">
    </div>
</header>

<section>
    <h2 class="titulo-centralizado">Visualizar agendamentos de Perícia Médica - Segurança do Trabalho</h2>
    <br>

    <form id="searchAgendamento">
        <div class="mb-3">
            <button type="button" class="btn btn-primary" onclick="window.location.href='agendamento.php'">NOVO AGENDAMENTO</button>
        </div><br>

        <div class="mb-3">
            <label>Data (Inicial e Final):</label><br>
            <input type="date" id="dataInicio" name="dataInicio" style="width: 20%;">
            <span>até</span>
            <input type="date" id="dataFim" name="dataFim" style="width: 20%;">
            <button type="submit" class="btn btn-primary">CONSULTAR</button>
        </div><br>
    </form>

    <div id="tabelaAgendamentos">
         
    </div>

    <!-- Modal    -->
    <div id="detalheModal" class="modal">
        <div class="modal-content">
            <span class="close" id="fecharModal">&times;</span>
            <h3>Detalhes do Agendamento</h3>
            <div id="modalDetalhes"></div>
        </div>
    </div>
</section>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Prefeitura de São Miguel do Iguaçu - Todos os direitos reservados.</p>
</footer>

<script>
    function carregarTabela() {
        const dataInicio = document.getElementById('dataInicio').value;
        const dataFim = document.getElementById('dataFim').value;

        const formData = new FormData();
        formData.append('dataInicio', dataInicio);
        formData.append('dataFim', dataFim);

        fetch('tabelaAgendamentos.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById('tabelaAgendamentos').innerHTML = html;
            ativarModal(); // reativaaa modal nos botões
        })
        .catch(err => console.error('Erro ao carregar tabela:', err));
    }

    function ativarModal() {
        document.querySelectorAll('.visualizar-btn').forEach(btn => {
            btn.onclick = () => {
                const details = JSON.parse(btn.getAttribute('data-details'));
                let html = '';
                for (let key in details) {
                    html += `<p><strong>${key}:</strong> ${details[key]}</p>`;
                }
                document.getElementById('modalDetalhes').innerHTML = html;
                document.getElementById('detalheModal').style.display = 'flex';
            };
        });

        document.getElementById('fecharModal').onclick = () => {
            document.getElementById('detalheModal').style.display = 'none';
        };

        window.onclick = (e) => {
            if (e.target === document.getElementById('detalheModal')) {
                document.getElementById('detalheModal').style.display = 'none';
            }
        };
    }

    // Inicia ao carregar
    window.onload = () => {
        carregarTabela();
        setInterval(carregarTabela, 5000); // atualiza a cada 5s

        document.getElementById('searchAgendamento').onsubmit = e => {
            e.preventDefault();
            carregarTabela();
        };
    };
</script>

</body>
</html>
