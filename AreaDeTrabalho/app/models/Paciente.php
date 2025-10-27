<?php 
require_once __DIR__ . '../config/Conexao.php';

class Paciente
{

    public function __construct()
    {
        $this->conn = Conexao::ConexaoBancoDeDados();
    }
    
    public function Cadastrar($cpf,$nome,$sexo,$idade,$id_leito,$id_medico_resp)
    {
        $sql = "INSERT INTO pacientes ('cpf','nome','sexo','idade','id_leito','medico_id') 
                VALUES (?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(
            "ssssii",
            $cpf,$nome,$sexo,$idade,$id_leito,$id_medico_resp
        );
        return $stmt->execute() ? "Cadastro Realizado" : "Erro ao Cadastrar";
    }
}

?>