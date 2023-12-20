<?php

    $texto = $_POST['morador'] . '#' . $_POST['unidade'] . '#' . $_POST['motorista'] . '#' . $_POST['modelo'] . '#' . $_POST['placa'] . '#' . $_POST['cor'] . PHP_EOL;

    $arquivo = fopen('arquivo.cd', 'a');

    fwrite($arquivo, $texto);

    fclose($arquivo);

    header('Location: index.html');

?>