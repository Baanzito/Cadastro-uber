<?php

    $veiculos = array();

    $arquivo = fopen('arquivo.cd', 'r');

    while(!feof($arquivo)) {

        $registro = fgets($arquivo);
        $veiculos[] = $registro;
    }

    fclose($arquivo);
?>

<html>
  <head>
    <meta charset="utf-8" />
    <title>Cadastro Uber</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-consultar-veiculo {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        Cadastro Uber
      </a>
      <ul class="navbar-nav"
        <li class="nav-item">
          <a class="nav-link" href="logoff.php">SAIR</a>
        </li>
    </nav>

    <div class="container">    
      <div class="row">

        <div class="card-consultar-veiculo">
          <div class="card">
            <div class="card-header">
              Veiculos Cadastrados
            </div>
            
            <div class="card-body">
              
              <? foreach($veiculos as $veiculo) { ?>

                <?
                
                    $veiculo_dados = explode('#', $veiculo);

                    if(count($veiculo_dados) < 4) {
                        continue;
                    }
                    
                ?>

                <div class="card mb-3 bg-light">
                  <div class="card-body">
                    <h5 class="card-title">Visitante: <?=$veiculo_dados[0]?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">CPF: <?=$veiculo_dados[1]?></h6>
                    <p class="card-text">Modelo: <?=$veiculo_dados[2]?></p>
                    <p class="card-text">Placa: <?=$veiculo_dados[3]?></p>
                    <p class="card-text">Cor: <?=$veiculo_dados[4]?></p>
                  </div>
                </div>
              <? } ?>

              <div class="row mt-5">
                <div class="col-6">
                  <a class="btn btn-lg btn-warning btn-block" href="index.html">Voltar</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>