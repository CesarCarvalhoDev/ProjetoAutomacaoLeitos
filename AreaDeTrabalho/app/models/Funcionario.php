<?php

require_once '../../config/Conexao.php';

class Funcionario
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexao::ConexaoBancoDeDados();
    }

    public function Login($email, $senha)
    {
        $stmt = $this->conn->prepare("SELECT * FROM funcionarios WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        return null;
    }

    public function Cadastro($nome, $sexo, $idade, $data_admissao, $email, $senha, $cargo_id)
    {
        $sql = "INSERT INTO funcionarios (nome, sexo, idade, data_admissao, email, senha, cargo_id) 
                VALUES (?,?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Erro ao preparar statement: " . $this->conn->error);
        }

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $stmt->bind_param("ssisssi", $nome, $sexo, $idade, $data_admissao, $email, $senhaHash, $cargo_id);

        return $stmt->execute() ? "Cadastro Realizado" : "Erro ao Cadastrar: " . $stmt->error;
    }
}
