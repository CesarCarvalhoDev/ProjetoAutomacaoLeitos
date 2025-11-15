<?php 

require_once __DIR__ . '/../../config/Conexao.php';

class Pedido
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexao::ConexaoBancoDeDados();
    }

    public function Criar(string $tipo_pedido,string $descricao,int $id_paciente,int $id_setor)
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

    public function ExibirPedidos()
    {
        $sql = " SELECT 
        pedidos.id AS pedidos_id,
        pedidos.status_pedido,
        pedidos.tipo_pedido,
        pedidos.descricao,
        pedidos.id_paciente,
        pedidos.id_setor,
        pacientes.nome,
        setores.nome
        FROM pedidos
        INNER JOIN pacientes
        ON pacientes.id = pedidos.id_paciente
        INNER JOIN setores
        ON setores.id = pedidos.id_setor
        ";
    }
}
?>
