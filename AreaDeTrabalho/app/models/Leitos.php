<?php 

require_once '../../config/Conexao.php';

class Leitos
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexao::ConexaoBancoDeDados();
    }

    public function CadastrarLeito($num_leito, $id_setor, $status_leito)
    {
        $sql = "INSERT INTO leitos (num_leito, id_setor, status_leito) VALUES (?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Erro ao preparar statement: " . $this->conn->error);
        }

        
        $stmt->bind_param("iis", $num_leito, $id_setor, $status_leito);

        if ($stmt->execute()) {
            return "Cadastro Realizado com sucesso!";
        } else {
            return "Erro ao cadastrar: " . $stmt->error;
        }
    }
}

?>
