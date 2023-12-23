<?php

function obterArquivoDoDia($filtroDataArquivo) {
    $pastaArquivos = 'Arquivos';
    $nomeArquivo = 'arquivo_' . str_replace('/', '_', $filtroDataArquivo) . '.cd';
    $caminhoCompleto = $pastaArquivos . '/' . $nomeArquivo;

    if (file_exists($caminhoCompleto)) {
        return $caminhoCompleto;
    } else {
        return false;
    }
}

function lerArquivoDoDiaComFiltro($filtroMorador, $filtroUnidade, $filtroDataArquivo) {
    $arquivoDoDia = obterArquivoDoDia($filtroDataArquivo);

    if ($arquivoDoDia !== false) {
        $linhas = file($arquivoDoDia, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $motoristasFiltrados = array();

        foreach ($linhas as $motorista) {
            $motorista_dados = explode('#', $motorista);

            if (
                count($motorista_dados) >= 7 &&
                (empty($filtroMorador) || stripos($motorista_dados[0], $filtroMorador) !== false) &&
                (empty($filtroUnidade) || stripos($motorista_dados[1], $filtroUnidade) !== false)
            ) {
                $motoristasFiltrados[] = $motorista;
            }
        }

        return $motoristasFiltrados;
    } else {
        return array();
    }
}

$filtroMorador = isset($_GET['filtroMorador']) ? $_GET['filtroMorador'] : '';
$filtroUnidade = isset($_GET['filtroUnidade']) ? $_GET['filtroUnidade'] : '';
$filtroDataArquivo = isset($_GET['filtroDataArquivo']) ? $_GET['filtroDataArquivo'] : '';

$filtroDataArquivoUnderscores = str_replace('/', '_', $filtroDataArquivo);

if (empty($filtroDataArquivoUnderscores)) {
    $filtroDataArquivoUnderscores = date('d_m_Y');
}

$motoristas = lerArquivoDoDiaComFiltro($filtroMorador, $filtroUnidade, $filtroDataArquivo);
?>

<html>
<head>
    <meta charset="utf-8"/>
    <title>Cadastro Uber</title>

    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <style>
        .container {
            margin-top: 20px;
        }

        .card-title {
            display: flex;
        }

        .card-text {
            word-wrap: break-word;
            margin-right: 20px;
            margin-left: 20px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        Cadastro Uber
    </a>
</nav>

<div class="container">

    <form class="form-inline" method="GET">
        <div class="form-group mx-sm-3 mb-2">
            <label for="filtroMorador" class="sr-only">Morador</label>
            <input type="text" class="form-control" id="filtroMorador" name="filtroMorador" placeholder="Morador">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <label for="filtroUnidade" class="sr-only">Unidade</label>
            <input type="text" class="form-control" id="filtroUnidade" name="filtroUnidade" placeholder="Unidade">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <label for="filtroDataArquivo" class="sr-only">Data (dd/mm/yyyy)</label>
            <input type="text" class="form-control" id="filtroDataArquivo" name="filtroDataArquivo" placeholder="Data (DD/MM/YYYY)"
                oninput="formatarData(this)">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Filtrar</button>
    </form>
    
    <ul class="list-group">
        <?php foreach ($motoristas as $motorista) { ?>
            <?php
            $motorista_dados = explode('#', $motorista);
            if (count($motorista_dados) < 7) {
                continue;
            }

            $dataSemUnderline = str_replace('_', '', $motorista_dados[6]);

            $dataFormatada = date("d/m/Y", strtotime(DateTime::createFromFormat('dmY', $dataSemUnderline)->format('Y-m-d')));
            $dataHoraFormatada = $dataFormatada . ' às ' . $motorista_dados[7];
            ?>

            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-2">
                        <h6>Morador: <?= $motorista_dados[0] ?></h6>
                        <p class="mb-1">Unidade: <?= $motorista_dados[1] ?></p>
                    </div>
                    <div class="col-md-2">
                        <p>Motorista: <?= $motorista_dados[2] ?></p>
                    </div>
                    <div class="col-md-2">
                        <p>Modelo: <?= $motorista_dados[3] ?></p>
                    </div>
                    <div class="col-md-2">
                        <p>Placa: <?= $motorista_dados[4] ?></p>
                    </div>
                    <div class="col-md-2">
                        <p>Cor: <?= $motorista_dados[5] ?></p>
                    </div>
                    <div class="col-md-2">
                        <p>Data do Registro: <?= $dataHoraFormatada ?></p>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>

<div id="customAlert" class="custom-alert" onclick="hideAlert()"></div>

<script>
  function registrar() {
    // Coletar dados do formulário
    var formData = new FormData(document.getElementById('registroForm'));

    // Enviar dados via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'registra_motorista.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Exibir o alerta
            const customAlert = document.getElementById('customAlert');
            customAlert.innerText = 'Cadastro realizado com sucesso!';
            customAlert.style.display = 'block';

            // Limpar os campos do formulário
            document.getElementById('registroForm').reset();
        } else {
            console.error('Erro ao processar a requisição.');
        }
    };
    xhr.send(formData);
  }

  // Função para ocultar o alerta
  function hideAlert() {
    const customAlert = document.getElementById('customAlert');
    customAlert.style.display = 'none';
  }
</script>

</body>
</html>