<?php

require_once __DIR__ . '/../../config/Conexao.php';

class Cargo
{
    private $conn;

    public function __construct() 
    {
        $this->conn = Conexao::ConexaoBancoDeDados();
    }

    public function ExibirCargosCadastrados()
    {
        $sql = "SELECT * FROM cargos";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>
