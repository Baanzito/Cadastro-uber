<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .card-registro {
            padding: 30px 0 0 0;
            width: 100%;
            margin: 0 auto;
        }

        .mensagem-erro {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
    <title>Cadastro Uber</title>

    <script>

        function obterParametroURL(nome) {
            nome = nome.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + nome + '=([^&#]*)');
            var resultados = regex.exec(location.search);
            return resultados === null ? '' : decodeURIComponent(resultados[1].replace(/\+/g, ' '));
        }

        var erro = obterParametroURL('error');
            if (erro === 'empty_fields') {
                alert('Por favor, preencha todos os campos corretamente.');
        }
    </script>

</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        Cadastramento Uber
    </a>
</nav>

<div class="container">
    <div class="row">

        <div class="card-registro">
            <div class="card">
                <div class="card-header">
                    Informações
                </div>
                <div class="card-body">
                    <form id="Formulario" method="post" action="registra_motorista.php" onsubmit="return validarFormulario()">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Morador</label>
                                    <input name="morador" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Unidade</label>
                                    <input name="unidade" type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nome do Motorista</label>
                                    <input name="motorista" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Placa</label>
                                    <input name="placa" id="placa" type="text" class="form-control" maxlength="8">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-6">
                                <button class="btn btn-success btn-lg btn-block" type="submit">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="mensagemErro" class="mensagem-erro"></div>

    </div>
</div>

<script>
    document.getElementById('placa').addEventListener('input', function (e) {
        let value = e.target.value;
        value = value.replace(/[^a-zA-Z0-9]/g, '');

        if (value.length > 3) {
            value = value.slice(0, 3) + '-' + value.slice(3);
        }

        if (value.length > 8) {
            value = value.slice(0, 8);
        }

        e.target.value = value.toUpperCase();
    });

    if (window.location.search.includes('success=true')) {
        alert('Cadastro realizado com sucesso!');
    }
</script>

</body>
</html>