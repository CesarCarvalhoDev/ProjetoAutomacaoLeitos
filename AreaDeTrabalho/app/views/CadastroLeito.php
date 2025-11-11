<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
    <link rel="stylesheet" href="statics/css/style.css" />
    <title>Nova Requisição de Serviço</title>
</head>

<body class="bg-light">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"></a>
                <div class="d-flex">
                    <a href="dashboard.html" class="btn btn-outline-light">Voltar ao Painel</a>
                </div>
            </div>
        </nav>
    </header>

    <main class="container my-5">
        <form action="Cadastro/submit" method="POST">
            <h1>Formulário de cadastro de leito</h1>
            <label for="">Número do Leito</label>
            <input type="number" name="numero_do_leito">
            <label for="">Setor</label>
            <select name="setor" id="">
                <?php 
                foreach ($setores_cadastrados as $setor) {
                    echo("<option value='{$setor['id']}'>{$setor['nome']}</option>");
                }
                ?>
            </select>
            <button type="submit" name="btn-acao" class="btn btn-info">Cadastrar</button>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-q0Co2Wv8sW9wY/mB8wzQ7fF3Z1tG8J9Z7oJ7oB4Z2c2O4k7fG9jFq0n+8lD5gB1Q" crossorigin="anonymous">
    </script>
</body>

</html>