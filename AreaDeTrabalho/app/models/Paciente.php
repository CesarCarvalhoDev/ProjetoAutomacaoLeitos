<?php 
require_once __DIR__ . '/../../config/Conexao.php';

class Paciente
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexao::ConexaoBancoDeDados();
    }
    
    public function Cadastrar($nome, $sexo, $idade, $id_leito, $id_func_resp)
    {
        $sql = "INSERT INTO pacientes (nome, sexo, idade, id_leito, id_func_resp) 
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Erro ao preparar statement: " . $this->conn->error);
        }
        
        $stmt->bind_param("ssiii", $nome, $sexo, $idade, $id_leito, $id_func_resp);

        if ($stmt->execute()) {
            return "Cadastro Realizado com sucesso!";
        } else {
            return "Erro ao cadastrar: " . $stmt->error;
        }
    }
}
?>
