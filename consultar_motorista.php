<?php

function obterArquivoDoDia() {
    $pastaArquivos = 'Arquivos';
    $nomeArquivo = 'arquivo_' . date("dmY") . '.cd';
    $caminhoCompleto = $pastaArquivos . '/' . $nomeArquivo;

    if (file_exists($caminhoCompleto)) {
        return $caminhoCompleto;
    } else {
        return false;
    }
}

function lerArquivoDoDia() {
    $arquivoDoDia = obterArquivoDoDia();

    if ($arquivoDoDia !== false) {
        $linhas = file($arquivoDoDia, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        return $linhas;
    } else {
        return false;
    }
}

$veiculos = array();

$arquivoDoDia = obterArquivoDoDia();

if ($arquivoDoDia !== false) {
    $linhas = lerArquivoDoDia();

    if ($linhas !== false) {
        // Adicionando as linhas do arquivo do dia ao array $veiculos
        $veiculos = array_merge($veiculos, $linhas);
    } else {
        echo "Erro ao ler o arquivo do dia.\n";
    }
} else {
    echo "Arquivo do dia não encontrado.\n";
}

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
    <div class="row card-consultar-veiculo">

        <?php foreach ($veiculos as $veiculo) { ?>

            <?php

            $veiculo_dados = explode('#', $veiculo);

            if (count($veiculo_dados) < 7) {
                continue;
            }

            // Adicionando barras à data e concatenando as horas
            $dataFormatada = substr($veiculo_dados[6], 0, 2) . '/' . substr($veiculo_dados[6], 2, 2) . '/' . substr($veiculo_dados[6], 4);
            $dataHoraFormatada = $dataFormatada . ' às ' . $veiculo_dados[7];

            ?>

            <div class="col-md-12">
                <div class="card bg-light">
                    <div class="card-header">
                        Veiculo Cadastrado
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <h6 class="card-title">Morador: <?= $veiculo_dados[0] ?></h6>
                                <h6 class="card-subtitle mb-2 text-muted">Unidade: <?= $veiculo_dados[1] ?></h6>
                            </div>
                            <div class="card-text">
                                <p>Motorista: <?= $veiculo_dados[2] ?></p>
                            </div>
                            <div>
                                <p>Modelo: <?= $veiculo_dados[3] ?></p>
                            </div>
                            <div class="card-text">
                                <p>Placa: <?= $veiculo_dados[4] ?></p>
                            </div>
                            <div>
                                <p>Cor: <?= $veiculo_dados[5] ?></p>
                            </div>
                            <div class="card-text">
                                <p>Data do Registro: <?= $dataHoraFormatada ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>
</body>
</html>