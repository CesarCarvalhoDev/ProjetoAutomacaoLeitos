<?php 

require_once __DIR__ . '../config/Conexao.php';

class Pedido
{
    
    public function __construct($conn)
    {
        $this->conn =  Conexao::ConexaoBancoDeDados();
    }

    public function CriarPedido($tipo_pedido,$descricao_breve)
    {
        $sql = "INSERT INTO pedidos ('tipo_pedido', 'descricao_breve') VALUES ('ss')";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(
            "ss",
            $tipo_pedido,$descricao_breve
        );
        return $stmt->execute() ? "Pedido Criado com sucesso" : "Erro Ao Criar";
    }

    
}
?>