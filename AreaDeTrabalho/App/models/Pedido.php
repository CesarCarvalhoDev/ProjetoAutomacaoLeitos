<?php 

class Pedido
{
    public string $status;
    public string $tipo_pedido;
    public string $descricao_breve;


    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function CriarPedido($tipo_pedido,$descricao_breve)
    {
        
    }


}




?>