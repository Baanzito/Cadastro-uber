<?php

date_default_timezone_set('America/Sao_Paulo');
$agora = time();
$dataAtual = date('dmY', $agora);
$horaAtual = date('H:i:s', $agora);

if ($horaAtual === '23:59:59') {
    $nomeArquivo = 'arquivos/arquivo_' . date('dmY', strtotime('+1 day')) . '.cd';
} else {
    $nomeArquivo = 'arquivos/arquivo_' . $dataAtual . '.cd';
}

$texto = $_POST['morador'] . '#' . $_POST['unidade'] . '#' . $_POST['motorista'] . '#' . $_POST['modelo'] . '#' . $_POST['placa'] . '#' . $_POST['cor'] . '#' . $dataAtual . '#' . $horaAtual . PHP_EOL;

if (!file_exists('arquivos')) {
    mkdir('arquivos');
}

$arquivo = fopen($nomeArquivo, 'a');

fwrite($arquivo, $texto);

fclose($arquivo);

header('Location: index.html');

?>