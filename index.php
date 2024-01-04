<?php

function obterArquivoDoDia($filtroDataArquivo) {
    $pastaArquivos = 'arquivos';
    $nomeArquivo = 'arquivo_' . str_replace('/', '_', $filtroDataArquivo) . '.cd';
    $caminhoCompleto = $pastaArquivos . '/' . $nomeArquivo;

    return file_exists($caminhoCompleto) ? $caminhoCompleto : false;
}

function lerArquivoDoDiaComFiltro($filtroMorador, $filtroUnidade, $filtroDataArquivo) {
    $filtroDataArquivoUnderscores = empty($filtroDataArquivo) ? date('d_m_Y') : str_replace('/', '_', $filtroDataArquivo);

    if (!empty($filtroDataArquivo)) {
        $filtroDataArquivoUnderscores = str_replace('/', '_', $filtroDataArquivo);
    }

    $arquivoDoDia = obterArquivoDoDia($filtroDataArquivoUnderscores);

    if ($arquivoDoDia !== false) {
        $linhas = file($arquivoDoDia, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $motoristasFiltrados = array();

        foreach ($linhas as $motorista) {
            $motorista_dados = explode('#', $motorista);

            if (
                count($motorista_dados) >= 6 &&
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

if (isset($_GET['reset'])) {
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

$filtroMorador = isset($_GET['filtroMorador']) ? $_GET['filtroMorador'] : '';
$filtroUnidade = isset($_GET['filtroUnidade']) ? $_GET['filtroUnidade'] : '';
$filtroDataArquivo = isset($_GET['filtroDataArquivo']) ? $_GET['filtroDataArquivo'] : '';

$motoristas = lerArquivoDoDiaComFiltro($filtroMorador, $filtroUnidade, $filtroDataArquivo);

$itensPorPagina = 20;

$totalPaginas = ceil(count($motoristas) / $itensPorPagina);

$paginaAtual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

$indiceInicial = ($paginaAtual - 1) * $itensPorPagina;

$motoristasPaginados = array_slice($motoristas, $indiceInicial, $itensPorPagina);
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

        body{
            font-size: 15;
        }

        .container {
            margin-top: 20px;
            padding: 0px;
            display: flexbox;
            padding: 10px 100px 10px 10px;
            max-height: 80vh;
            overflow-y: auto;
        }

        li {
            word-wrap: break-word;
            margin-right: 20px;
            margin-left: 20px;
        }

        .list-group-item {
        font-size: 0.9em;
        
        }

        .pagination li {
        margin-right: -17px;
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
            <input type="text" class="form-control" id="filtroDataArquivo" name="filtroDataArquivo" placeholder="Data (DD/MM/AAAA)" oninput="formatarData(this)" onkeydown="tratarBackspace(event)">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Filtrar</button>
    </form>
    
    <ul class="list-group">
        <?php
        if (empty($motoristas)) {
            echo '<li class="list-group-item">Nenhum registro encontrado.</li>';
        } else {
            echo '<li class="list-group-item font-weight-bold">
                    <div class="row">
                        <div class="col-md-2">Morador</div>
                        <div class="col-md-2">Unidade</div>
                        <div class="col-md-2">Motorista</div>
                        <div class="col-md-2">Placa</div>
                        <div class="col-md-3">Data do Registro</div>
                    </div>
                </li>';

            foreach ($motoristas as $motorista) {
                $motorista_dados = explode('#', $motorista);
                if (count($motorista_dados) < 6) {
                    continue;
                }

                $dataSemUnderline = str_replace('_', '', $motorista_dados[4]);
                $dataFormatada = DateTime::createFromFormat('dmY', $dataSemUnderline);

                if ($dataFormatada !== false) {
                    $dataFormatada = $dataFormatada->format('d/m/Y');
                } else {
                    $dataFormatada = 'Data inválida';
                }

                $dataHoraFormatada = $dataFormatada . ' às ' . $motorista_dados[5];

                echo '<li class="list-group-item">
                        <div class="row">
                            <div class="col-md-2">
                                <p>' . $motorista_dados[0] . '</p>
                            </div>
                            <div class="col-md-2">
                                <p>' . $motorista_dados[1] . '</p>
                            </div>
                            <div class="col-md-2">
                                <p>' . $motorista_dados[2] . '</p>
                            </div>
                            <div class="col-md-2">
                                <p>' . $motorista_dados[3] . '</p>
                            </div>
                            <div class="col-md-3">
                                <p>' . $dataHoraFormatada . '</p>
                            </div>
                        </div>
                    </li>';
            }
        }
        ?>
    </ul>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPaginas; $i++) : ?>
                <li class="page-item <?php echo ($i == $paginaAtual) ? 'active' : ''; ?>">
                    <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>

</div>

<script>
    function formatarData(input) {
        var valorAtual = input.value.replace(/\D/g, '');

        if (valorAtual !== "") {
            var dia = valorAtual.substring(0, 2);
            var mes = valorAtual.substring(2, 4);
            var ano = valorAtual.substring(4, 8);
            var dataFormatada = "";

            if (dia.length > 0) {
                dataFormatada += dia;
                if (dia.length >= 2) {
                    dataFormatada += '/';
                }
            }
            if (mes.length > 0) {
                dataFormatada += mes;
                if (mes.length >= 2) {
                    dataFormatada += '/';
                }
            }
            dataFormatada += ano;

            input.value = dataFormatada;
        }
    }

    function tratarBackspace(event) {
        if (event.keyCode === 8) {
            var campo = document.getElementById('filtroDataArquivo');
            campo.value = campo.value.slice(0, -1);
        }
    }
</script>

</body>
</html>