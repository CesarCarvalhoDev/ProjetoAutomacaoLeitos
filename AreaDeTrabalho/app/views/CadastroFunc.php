<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
    <link rel="stylesheet" href="/statics/css/style.css" />
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
            <h1>Formulário de cadastro de colaborador</h1>
            <label for="">Nome:</label>
            <input type="text" name="nome" required />
            <label for="">Sexo:</label>
            <select name="sexo" id="" required>
                <option value="Feminino">Feminino</option>
                <option value="Masculino">Masculino</option>
            </select>
            <label for="">Idade:</label>
            <input type="number" name="idade"required />
            <label for="">Data de admisao</label>
            <input type="date" name="data_adimisao" required/>
            <label for="">Setor</label>
            <select name="setor" id="">
                <?php 
                foreach ($setores_cadastrados as $setor) {
                    echo("<option value='{$setor['id']}'>{$setor['nome']}</option>");
                }
                ?> 
            </select>
            <label for="">Cargo</label>
            <select name="cargo" id="" required>
              <?php 
              foreach ($cargos_cadastrados as $cargo) {
                echo "<option value='{$cargo['id']}'>{$cargo['descricao']}</option>";
              }
              ?>
            </select>
            <label for="">Email:</label>
            <input type="email" name="email" required>
            <label for="">Senha:</label>
            <input type="password" name="senha" required>
            <button type="submit" name="acao" class="btn btn-info">Cadastrar</button>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-q0Co2Wv8sW9wY/mB8wzQ7fF3Z1tG8J9Z7oJ7oB4Z2c2O4k7fG9jFq0n+8lD5gB1Q" crossorigin="anonymous">
    </script>
</body>

</html>