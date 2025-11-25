<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos dos Pacientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
                "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji",
                "Segoe UI Emoji", "Segoe UI Symbol";
            background-color: #f4f7f9;
        }

        #logo {
            width: 30px;
            height: 30px;
        }

        .sidebar {
            background-color: #ffffff;
            border-right: 1px solid #e0e0e0;
            padding: 1.5rem;
            min-height: 100vh;
        }

        .main-content {
            padding: 1.5rem;
        }
    </style>

</head>

<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="/assets/273050775_611645833231749_8101898732572474785_n-fotor-bg-remover-20251117221339.png"
                     alt="Logo" id="logo"
                     class="d-inline-block align-text-top me-2 rounded"/>

                <span class="fw-bolder">Setor | Pedidos</span>
            </a>

            <div class="ms-auto d-flex align-items-center text-white">
                <span class="fw-bold me-3">
                    Olá, <?= htmlspecialchars($usuario['nome_func'] ?? 'Colaborador') ?>
                </span>
            </div>
        </div>
    </nav>
</header>

<main class="container-fluid my-0 p-0">
<div class="row g-0">

    <!-- SIDEBAR -->
    <div class="col-md-3 sidebar shadow-sm d-none d-md-block">

        <h4 class="mb-4 text-primary">Informações do Setor</h4>
        <p class="mb-4">
            Setor: <strong><?= htmlspecialchars($usuario['nome_setor'] ?? 'Não Definido') ?></strong>
        </p>

        <hr>

        <h4 class="mb-3 text-secondary">Minhas Requisições</h4>

        <?php if (empty($minhas_requisicoes)): ?>
            <p class="text-muted small">Você ainda não tem pedidos atribuídos.</p>

        <?php else: ?>

            <?php
            $em_atendimento = count(array_filter($minhas_requisicoes, fn($req) => $req['status_pedido'] === 'Em andamento'));
            $concluidas     = count(array_filter($minhas_requisicoes, fn($req) => $req['status_pedido'] === 'Concluido'));
            ?>

            <div class="mb-2 small">
                <span class="badge bg-warning text-dark">Em andamento: <?= $em_atendimento ?></span>
                <span class="badge bg-success text-white ms-2">Concluídas: <?= $concluidas ?></span>
            </div>

            <div class="list-group list-group-flush small" style="max-height: 400px; overflow-y: auto;">
                <?php foreach ($minhas_requisicoes as $req): ?>

                    <?php
                    $status_class = match ($req['status_pedido']) {
                        'Em andamento' => 'list-group-item-warning',
                        'Concluido'    => 'list-group-item-success',
                        default        => ''
                    };
                    ?>

                    <div class="list-group-item d-flex justify-content-between align-items-center <?= $status_class ?>">
                        <div>#<?= $req['id'] ?> - <?= htmlspecialchars($req['nome_paciente']) ?></div>
                        <span class="badge bg-primary"><?= $req['status_pedido'] ?></span>
                    </div>

                <?php endforeach; ?>
            </div>

        <?php endif; ?>

        <hr class="mt-4">

        <h5 class="mt-4 mb-3 text-secondary">Filtrar Pedidos</h5>
        <select class="form-select" id="filtroStatus">
            <option value="todos" selected>Todos os Status</option>
            <option value="Em aberto">Aguardando (Em aberto)</option>
            <option value="Em andamento">Em Andamento</option>
            <option value="Concluido">Concluídos</option>
        </select>

    </div>

    <!-- CONTEÚDO PRINCIPAL -->
    <div class="col-md-9 main-content">

        <h1 class="mb-4 text-primary">Pedidos dos Pacientes</h1>

        <div id="alert-messages" class="mb-3"></div>

        <?php if (empty($pedidos)): ?>

            <div class="alert alert-info shadow-sm" id="no-pedidos-alert">
                Nenhum pedido encontrado para este setor.
            </div>

        <?php else: ?>

            <div class="row g-4" id="pedidos-list">

                <?php foreach ($pedidos as $pedido): ?>

                    <?php
                    // BADGE DE STATUS
                    $status_badge_class = match ($pedido['status_pedido']) {
                        'Em aberto'     => 'bg-danger text-white',
                        'Em andamento'  => 'bg-warning text-dark',
                        'Concluido'     => 'bg-success text-white',
                        default         => 'bg-secondary text-white'
                    };

                    // É MEU?
                    $is_mine = (
                        $pedido['status_pedido'] === 'Em andamento'
                        && isset($pedido['id_func_responsavel'])
                        && $pedido['id_func_responsavel'] == $usuario['id_func']
                    );

                    // LÓGICA DO BOTÃO
                    if ($pedido['status_pedido'] === 'Em aberto') {
                        $btn_text = 'Atender Pedido';
                        $btn_class = 'btn-success';
                        $action_type = 'atender';
                        $is_disabled = '';

                    } elseif ($pedido['status_pedido'] === 'Em andamento') {

                        if ($is_mine) {
                            $btn_text = 'Concluir Pedido';
                            $btn_class = 'btn-primary';
                            $action_type = 'concluir';
                            $is_disabled = '';
                        } else {
                            $btn_text = 'Em andamento...';
                            $btn_class = 'btn-secondary';
                            $action_type = '';
                            $is_disabled = 'disabled';
                        }

                    } elseif ($pedido['status_pedido'] === 'Concluido') {
                        $btn_text = 'Concluído';
                        $btn_class = 'btn-secondary';
                        $action_type = '';
                        $is_disabled = 'disabled';
                    }
                    ?>

                    <div class="col-sm-6 col-lg-4 pedido-card"
                         data-status="<?= htmlspecialchars($pedido['status_pedido']) ?>"
                         id="pedido-<?= htmlspecialchars($pedido['pedidos_id']) ?>">

                        <div class="card shadow-sm h-100 border-0">

                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <strong>Pedido #<?= htmlspecialchars($pedido['pedidos_id']) ?></strong>
                                <span class="badge bg-light text-primary">
                                    <?= ucfirst(htmlspecialchars($pedido['tipo_pedido'])) ?>
                                </span>
                            </div>

                            <div class="card-body">

                                <p class="mb-1">
                                    <small class="text-muted">Paciente:</small><br>
                                    <strong><?= htmlspecialchars($pedido['nome_paciente']) ?></strong>
                                </p>

                                <p class="mb-3">
                                    <small class="text-muted">Status:</small>
                                    <span class="badge <?= $status_badge_class ?> ms-1">
                                        <?= htmlspecialchars($pedido['status_pedido']) ?>
                                    </span>
                                </p>

                                <hr>

                                <h6 class="card-subtitle mb-2 text-muted">Descrição do Pedido:</h6>
                                <p class="card-text small text-break">
                                    <?= nl2br(htmlspecialchars($pedido['descricao'])) ?>
                                </p>

                                <hr>

                                <p class="mb-0 small text-muted">
                                    Setor Solicitante: <?= htmlspecialchars($pedido['nome_setor']) ?>
                                </p>

                            </div>

                            <div class="card-footer text-end bg-light border-0">
                                <button
                                    class="btn <?= $btn_class ?> w-100 action-btn"
                                    data-id="<?= htmlspecialchars($pedido['pedidos_id']) ?>"
                                    data-action="<?= $action_type ?>"
                                    <?= $is_disabled ?>>
                                    <?= $btn_text ?>
                                </button>
                            </div>

                        </div>
                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>
</div>
</main>

<footer class="footer py-3 bg-white border-top">
    <div class="container text-center">
        <span class="text-muted small">Sistema de Administração © 2025</span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const filtroStatus = document.getElementById('filtroStatus');

    if (filtroStatus) {
        filtroStatus.addEventListener('change', function () {
            const selectedStatus = this.value;
            const cards = document.querySelectorAll('.pedido-card');
            let anyVisible = false;

            cards.forEach(card => {
                const cardStatus = card.getAttribute('data-status');

                if (selectedStatus === 'todos' || cardStatus === selectedStatus) {
                    card.style.display = 'block';
                    anyVisible = true;
                } else {
                    card.style.display = 'none';
                }
            });

            const noPedidosAlert = document.getElementById('no-pedidos-alert');
            if (noPedidosAlert) {
                noPedidosAlert.style.display = anyVisible ? 'none' : 'block';
            }
        });
    }

    const actionButtons = document.querySelectorAll('.action-btn');
    const alertMessages = document.getElementById('alert-messages');

    actionButtons.forEach(button => {
        button.addEventListener('click', async function () {
            const pedidoId = this.getAttribute('data-id');
            const action = this.getAttribute('data-action');
            let originalText = this.textContent;

            if (!action) return;

            if (!confirm(`Tem certeza que deseja ${action === 'atender' ? 'iniciar' : 'concluir'} o pedido #${pedidoId}?`)) {
                return;
            }

            const url = '/Func/ProcessarAcaoPedido';

            try {
                this.disabled = true;
                this.textContent = 'Processando...';
                alertMessages.innerHTML = '';

                const response = await fetch(url, {
                    method: 'POST',
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    body: `id_pedido=${pedidoId}&acao=${action}&id_func=<?= htmlspecialchars($usuario['id_func'] ?? '0') ?>`
                });

                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('Erro HTTP:', errorText);
                    throw new Error(`Erro HTTP: ${response.status}`);
                }

                const data = await response.json();
                const alertClass = data.status === 'success' ? 'alert-success' : 'alert-danger';

                alertMessages.innerHTML =
                    `<div class="alert ${alertClass} shadow-sm" role="alert">${data.message}</div>`;

                if (data.status === 'success') {
                    setTimeout(() => window.location.reload(), 800);
                } else {
                    this.disabled = false;
                    this.textContent = originalText;
                }

            } catch (error) {
                console.error('Erro:', error);
                alertMessages.innerHTML =
                    `<div class="alert alert-danger shadow-sm" role="alert">${error.message}</div>`;

                this.disabled = false;
                this.textContent = originalText;
            }
        });
    });

});
</script>

</body>
</html>
