<?php

function getDataAtualFormatada() {
    return date("dmY");
}

function getNomeArquivo() {
    return 'arquivo_' . getDataAtualFormatada() . '.cd';
}

function arquivoDoDiaAtualExiste() {
    return file_exists(getNomeArquivo());
}

function moverArquivoParaPastaArquivos() {
    $nomeArquivo = getNomeArquivo();
    $pastaArquivos = 'Arquivos';

    if (!file_exists($pastaArquivos)) {
        mkdir($pastaArquivos);
    }

    rename($nomeArquivo, $pastaArquivos . '/' . $nomeArquivo);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $morador = $_POST['morador'];
    $unidade = $_POST['unidade'];
    $motorista = $_POST['motorista'];
    $modelo = $_POST['modelo'];
    $placa = $_POST['placa'];
    $cor = $_POST['cor'];

    $data = date("dmY");
    $hora = date("H:i:s");

    if (!arquivoDoDiaAtualExiste()) {
        $arquivo = fopen(getNomeArquivo(), 'a');
        fclose($arquivo);
    }

    $texto = "$morador#$unidade#$motorista#$modelo#$placa#$cor#$data#$hora" . PHP_EOL;

    $arquivo = fopen(getNomeArquivo(), 'a');

    fwrite($arquivo, $texto);

    fclose($arquivo);

    if (date("H:i:s") >= "00:00:00") {
        moverArquivoParaPastaArquivos();
    }
    
    header('Location: index.html');
}
?>