<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />

    <!-- FontAwesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    <!-- CSS Local -->
    <link rel="stylesheet" href="statics/css/style.css" />

    <title>Nova Requisição de Serviço</title>
</head>

<body class="bg-light">

    <!-- NAVBAR -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Sistema de Requisições</a>
                <div class="d-flex">
                    <a href="" class="btn btn-outline-light">Voltar ao Painel</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="container my-5">

        <!-- Saudação -->
        <div class="row mb-4">
            <div class="col-12" id="bem_vindo">
                <div class="p-4 bg-white rounded shadow-sm border-start border-primary border-5">
                    <h1 class="text-primary">
                        Bem Vindo,
                        <span class="fw-bold"><?= $_SESSION['nome_paciente'] ?></span>
                    </h1>
                    <p class="mb-0">
                        Use o formulário abaixo para solicitar serviços de suporte.
                        Preencha o tipo de pedido e forneça uma breve descrição.
                    </p>
                </div>
            </div>
        </div>

        <!-- GRID PRINCIPAL -->
        <div class="row">

            <!-- FORMULÁRIO -->
            <div class="col-lg-8 col-12 mb-4">
                <form action="/AreaDeTrabalho/public/Home/submit" method="POST" id="form-requisicao">
                    <div class="card p-4 shadow border-0">

                        <h2 class="card-title mb-4 text-secondary">Formulário de Pedido de Serviço</h2>

                        <!-- Inputs ocultos -->
                        <input type="hidden" name="id_paciente" value="<?= (int)$_SESSION['id_paciente'] ?>">
                        <input type="hidden" name="id_setor" value="<?= (int)$_SESSION['id_setor'] ?>">
                        <input type="hidden" name="tipo_pedido" id="tipo_escolhido">

                        <!-- Seleção do tipo -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Selecione o Tipo de Pedido:</label>

                            <div class="d-flex flex-wrap gap-3" id="box-btn-tipo_pedido">

                                <button type="button" onclick="selecionarTipo('enfermagem')"
                                    class="btn btn-outline-primary btn-lg d-flex align-items-center"
                                    style="min-width:200px">
                                    <span style="padding: 10px;">
                                        <i class="fa-solid fa-user-doctor fa-2x me-2"></i>
                                        Enfermagem
                                    </span>
                                </button>

                                <button type="button" onclick="selecionarTipo('camareira')"
                                    class="btn btn-outline-info btn-lg d-flex align-items-center">
                                    <span style="padding: 10px;">
                                        <i class="fa-solid fa-bed fa-2x me-2"></i>
                                        Camareira
                                    </span>
                                </button>

                                <button type="button" onclick="selecionarTipo('manutencao')"
                                    class="btn btn-outline-warning btn-lg d-flex align-items-center">
                                    <span style="padding: 10px;">
                                        <i class="fa-solid fa-screwdriver-wrench fa-2x me-2"></i>
                                        Manutenção
                                    </span>
                                </button>

                                <button type="button" onclick="selecionarTipo('cozinha')"
                                    class="btn btn-outline-success btn-lg d-flex align-items-center">
                                    <span style="padding: 10px;">
                                        <i class="fa-solid fa-bell-concierge fa-2x me-2"></i>
                                        Cozinha
                                    </span>
                                </button>

                            </div>
                        </div>

                        <!-- Descrição -->
                        <div class="mb-3">
                            <label for="descricao_breve" class="form-label fw-bold">
                                Descrição Detalhada do Serviço:
                            </label>

                            <textarea
                                name="descricao"
                                id="descricao_breve"
                                class="form-control"
                                rows="4"
                                placeholder="Descreva a necessidade com mais detalhes...">
                            </textarea>
                        </div>

                        <!-- Enviar -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Enviar Requisição
                            </button>
                        </div>

                    </div>
                </form>
            </div>

            <!-- COLUNA LATERAL -->
            <div class="col-lg-4 col-12">

                <!-- Pedidos Realizados -->
                <div class="card shadow p-4 border-0">

                    <h5 class="text-primary mb-3">Pedidos Realizados</h5>

                    <div style="max-height: 300px; overflow-y: auto; padding-right: 10px;">
                        <ul class="list-group">

                            <?php if (!empty($pedidos_paciente)) : ?>

                                <?php foreach ($pedidos_paciente as $p) : ?>
                                    <li class="list-group-item">
                                        <strong><?= ucfirst($p['tipo_pedido']) ?></strong><br>
                                        <small><?= $p['descricao'] ?></small><br>

                                        <span class="badge 
                                    <?php
                                    if ($p['status_pedido'] === 'Em aberto') {
                                        echo 'bg-warning text-dark';
                                    } elseif ($p['status_pedido'] === 'Em andamento') {
                                        echo 'bg-primary';
                                    } elseif ($p['status_pedido'] === 'concluido') {
                                        echo 'bg-success';
                                    } else {
                                        echo 'bg-secondary';
                                    }
                                    ?> mt-2">
                                            <?= ucfirst($p['status_pedido']) ?>
                                        </span>

                                    </li>
                                <?php endforeach; ?>

                            <?php else : ?>

                                <li class="list-group-item text-muted">
                                    Nenhum pedido encontrado.
                                </li>

                            <?php endif; ?>

                        </ul>
                    </div>

                </div>

            </div>

        </div>

    </main>

    <!-- Funções -->
    <script>
        function selecionarTipo(tipo) {
            document.getElementById('tipo_escolhido').value = tipo;
        }
    </script>

    <!-- Bootstrap Bundle -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-q0Co2Wv8sW9wY/mB8wzQ7fF3Z1tG8J9Z7oJ7oB4Z2c2O4k7fG9jFq0n+8lD5gB1Q"
        crossorigin="anonymous">
    </script>

</body>

</html>