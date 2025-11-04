<?php 

require_once  '../../config/Conexao.php';

class Setor
{
    private $conn; 

    public function __construct() {
        $this->conn = Conexao::ConexaoBancoDeDados();
    }

    public function Cadastrar($nome)
    {
        $sql = "INSERT INTO setores (nome) VALUES (?)";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Erro ao preparar statement: " . $this->conn->error);
        }

        $stmt->bind_param("s", $nome);

        if ($stmt->execute()) {
            return "Cadastro realizado com sucesso!";
        } else {
            return "Erro ao cadastrar: " . $stmt->error;
        }
    }
}
?>
