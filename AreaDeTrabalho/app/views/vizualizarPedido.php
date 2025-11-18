<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Pedidos dos Pacientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ====== ESTILOS REPLICADOS DA PÁGINA DO ADMIN ====== */

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji",
                "Segoe UI Emoji", "Segoe UI Symbol";
            background-color: #f8f9fa;
        }

        #logo {
            width: 30px;
            height: 30px;
        }

        #user {
            border: 2px solid #ffffff;
        }

        .card {
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
        }
    </style>

</head>

<body>

    <!-- NAVBAR NO MESMO MODELO DA PÁGINA PRINCIPAL -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="/assets/273050775_611645833231749_8101898732572474785_n-fotor-bg-remover-20251117221339.png" alt="Logo" id="logo"
                        class="d-inline-block align-text-top me-2 rounded" />
                    Pedidos do Setor
                </a>

                <div class="d-none d-md-block mx-auto"></div>

                <div class="d-flex align-items-center text-white">
                    <span class="fw-bold">
                        <?= htmlspecialchars($usuario['nome'] ?? 'Colaborador') ?>
                    </span>
                </div>
            </div>
        </nav>
    </header>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="container my-5">

        <h1 class="mb-3 text-primary">Pedidos dos Pacientes</h1>

        <h4 class="mb-2">
            Olá <strong><?= htmlspecialchars($usuario['nome']) ?></strong>
        </h4>

        <h5 class="text-secondary mb-4">
            Setor: <?= htmlspecialchars($usuario['nome_setor']) ?>
        </h5>

        <?php if (empty($pedidos)): ?>

            <div class="alert alert-info shadow-sm">
                Nenhum pedido encontrado para este setor.
            </div>

        <?php else: ?>

            <div class="row g-4">
                <?php foreach ($pedidos as $pedido): ?>
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">

                            <div class="card-header bg-primary text-white">
                                <strong>Pedido #<?= htmlspecialchars($pedido['pedidos_id']) ?></strong>
                            </div>

                            <div class="card-body">
                                <p><strong>Status:</strong> <?= htmlspecialchars($pedido['status_pedido']) ?></p>
                                <p><strong>Tipo:</strong> <?= ucfirst(htmlspecialchars($pedido['tipo_pedido'])) ?></p>
                                <p><strong>Descrição:</strong><br><?= nl2br(htmlspecialchars($pedido['descricao'])) ?></p>
                                <hr>
                                <p><strong>Paciente:</strong> <?= htmlspecialchars($pedido['nome_paciente']) ?></p>
                                <p><strong>Setor:</strong> <?= htmlspecialchars($pedido['nome_setor']) ?></p>
                            </div>

                            <div class="card-footer text-end">
                                <button class="btn btn-success btn-sm">Atender</button>
                                <button class="btn btn-danger btn-sm">Cancelar</button>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">Sistema de Administração &copy; 2025</span>
        </div>
    </footer>

</body>
</html>
