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

    public function AtribuirPedido()
    {
        
    }
}
?>
