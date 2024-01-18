<?php
date_default_timezone_set('America/Sao_Paulo');

function camposPreenchidos($campos) {
    foreach ($campos as $campo) {
        if (empty($_POST[$campo])) {
            return false;
        }
    }
    return true;
}

$camposObrigatorios = ['morador', 'unidade', 'motorista', 'placa'];
    if (camposPreenchidos($camposObrigatorios)) {

    $agora = time();
    $dataAtual = date('d_m_Y', $agora);
    $horaAtual = date('H:i:s', $agora);

    if ($horaAtual === '23:59:59') {
        $nomeArquivo = 'arquivos/arquivo_' . date('d_m_Y', strtotime('+1 day')) . '.cd';
    } else {
        $nomeArquivo = 'arquivos/arquivo_' . $dataAtual . '.cd';
    }

    $texto = $_POST['morador'] . '#' . $_POST['unidade'] . '#' . $_POST['motorista'] . '#' . $_POST['placa'] . '#' . $dataAtual . '#' . $horaAtual . PHP_EOL;

    if (!file_exists('arquivos')) {
        mkdir('arquivos');
    }

    $arquivo = fopen($nomeArquivo, 'a');

    fwrite($arquivo, $texto);

    fclose($arquivo);

    header('Location: cadastrar.php?success=true');
    exit();
} else {

    header('Location: cadastrar.php?error=empty_fields');
    exit();
}
?>