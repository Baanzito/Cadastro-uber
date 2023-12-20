<?php

$veiculos = array();

$arquivo = fopen('arquivo.cd', 'r');

while (!feof($arquivo)) {
    $registro = fgets($arquivo);
    $veiculos[] = $registro;
}

fclose($arquivo);

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
    </style>
</head>

<body>

<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        Cadastro Uber
    </a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="logoff.php">SAIR</a>
        </li>
    </ul>
</nav>

<div class="container">
    <div class="row card-consultar-veiculo">

        <?php foreach ($veiculos as $veiculo) { ?>

            <?php

            $veiculo_dados = explode('#', $veiculo);

            if (count($veiculo_dados) < 6) {
                continue;
            }

            ?>

            <div class="col-md-12">
                <div class="card bg-light">
                    <div class="card-header">
                        Veiculo Cadastrado
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <h5 class="card-title">Morador: <?= $veiculo_dados[0] ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted">Unidade: <?= $veiculo_dados[1] ?></h6>
                            </div>
                            <div class="col-md-2">
                                <p class="card-text">Motorista: <?= $veiculo_dados[2] ?></p>
                            </div>
                            <div class="col-md-2">
                                <p class="card-text">Modelo: <?= $veiculo_dados[3] ?></p>
                            </div>
                            <div class="col-md-2">
                                <p class="card-text">Placa: <?= $veiculo_dados[4] ?></p>
                            </div>
                            <div class="col-md-2">
                                <p class="card-text">Cor: <?= $veiculo_dados[5] ?></p>
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