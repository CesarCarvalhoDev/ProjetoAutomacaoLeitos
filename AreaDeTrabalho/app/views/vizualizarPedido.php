<?php
// Conexão com o banco (ajuste para seu ambiente)
$pdo = new PDO("mysql:host=root;dbname=db_automacao_leitos;charset=utf8", "root", "123");
 
// Busca dos pedidos
$sql = $pdo->query("
    SELECT pedidos_id, status_pedido, tipo_pedido, descricao, id_paciente, id_setor, nome AS nome_paciente, nome AS nome_setor
    FROM pedidos
");
$pedidos = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pedidos dos Pacientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">Pedidos dos Pacientes</h2>

    <div class="row">
        <?php foreach ($pedidos as $pedido): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <strong>Pedido #<?= $pedido['pedidos_id'] ?></strong>
                    </div>

                    <div class="card-body">
                        <p><strong>Status:</strong> <?= $pedido['status_pedido'] ?></p>
                        <p><strong>Tipo:</strong> <?= ucfirst($pedido['tipo_pedido']) ?></p>
                        <p><strong>Descrição:</strong><br><?= $pedido['descricao'] ?></p>
                        <hr>
                        <p><strong>Paciente:</strong> <?= $pedido['nome_paciente'] ?></p>
                        <p><strong>Setor:</strong> <?= $pedido['nome_setor'] ?></p>
                    </div>

                    <div class="card-footer text-end">
                        <button class="btn btn-success btn-sm">Atender</button>
                        <button class="btn btn-danger btn-sm">Cancelar</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

</body>
</html>
