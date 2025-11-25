<?php

require_once __DIR__ . '/../../config/Conexao.php';

class Pedido
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexao::ConexaoBancoDeDados();
    }

    public function Criar(string $tipo_pedido, string $descricao, int $id_paciente, int $id_setor)
    {
        $sql = "INSERT INTO pedidos (tipo_pedido, descricao, id_paciente, id_setor) 
                VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Erro ao preparar statement: " . $this->conn->error);
        }

        $stmt->bind_param(
            "ssii",
            $tipo_pedido,
            $descricao,
            $id_paciente,
            $id_setor
        );

        if ($stmt->execute()) {
            return "Pedido criado com sucesso!";
        } else {
            return "Erro ao criar pedido: " . $stmt->error;
        }
    }

    public function ExibirPedidosSetor(int $id_setor)
    {
        $sql = " SELECT 
        pedidos.id AS pedidos_id,
        pedidos.status_pedido,
        pedidos.tipo_pedido,
        pedidos.descricao,
        pedidos.id_paciente,
        pedidos.id_setor,
        pedidos.id_func_responsavel,
        pacientes.nome AS nome_paciente,
        setores.nome   AS nome_setor
        FROM pedidos
        INNER JOIN pacientes
        ON pacientes.id = pedidos.id_paciente
        INNER JOIN setores
        ON setores.id = pedidos.id_setor
        WHERE setores.id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_setor);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function ExibirPedidos()
    {
        $sql = "SELECT pedidos.*, pacientes.id AS paciente_id
                FROM pedidos
                INNER JOIN pacientes
                ON pacientes.id = pedidos.id_paciente";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function ExibirPedidosFunc($id_func)
    {
        $sql = "SELECT pedidos.*, pacientes.nome AS nome_paciente
                FROM pedidos 
                INNER JOIN pacientes ON pacientes.id = pedidos.id_paciente 
                WHERE id_func_responsavel = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$id_func);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function AtribuirPedido(int $id_pedido, int $id_func)
    {
        $sql = "UPDATE pedidos
            SET id_func_responsavel = ?, status_pedido = 'Em andamento'
            WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $id_func, $id_pedido);

        if ($stmt->execute()) {
            return $stmt->affected_rows; 
        } else {
            return false;
        }
    }

    public function ConcluirPedido($id_pedido)
    {
        $sql = "UPDATE pedidos 
                SET status_pedido = 'Concluido'
                WHERE pedidos.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i',$id_pedido);
        if ($stmt->execute()) {
            return $stmt->affected_rows; 
        } else {
            return false;
        }
    }
}
