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
            <label for="">Nome:</label>
            <input type="text" name="nome">
            <label for="">Sexo</label>
            <select name="sexo" id="">
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
            </select>
            <label for="">Idade</label>
            <input type="number" name="idade">
            <label for="">Leito</label>
            <select name="leito" id="">
                <?php
                foreach ($leitos_cadastrados as $leito) {
                    echo "
                    <option value='{$leito['id']}'>
                    Número Leito: {$leito['num_leito']} - Setor: {$leito['nome_setor']}
                    </option>
                    ";
                }
                ?>
            </select>
            <label for="">Médico Reponsável</label>
            <select name="medico" id="">
                <?php
                foreach ($medicos_cadastrados as $medico) {
                    echo "<option value='{$medico['id']}'>{$medico['nome']}</option>";
                }
                ?>
            </select>
            <button type="submit" class="btn btn-info">Cadastrar</button>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-q0Co2Wv8sW9wY/mB8wzQ7fF3Z1tG8J9Z7oJ7oB4Z2c2O4k7fG9jFq0n+8lD5gB1Q" crossorigin="anonymous">
    </script>
</body>

</html>