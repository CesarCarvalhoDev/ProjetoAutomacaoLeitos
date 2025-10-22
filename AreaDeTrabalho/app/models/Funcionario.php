<?php

require_once __DIR__ . '../config/Conexao.php';


class Funcionario
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexao::ConexaoBancoDeDados();
    }

    public function LoginFuncionario($email, $senha)
    {
        $stmt = $this->conn->prepare("SELECT * FROM funcionarios WHERE email = ? AND senha = ? LIMIT 1");
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: null;
    }

    public function CadastroFuncionario($nome, $cpf, $data_nasc, $sexo, $telefone, $email, $senha, $endereco, $bairro, $cargo_id, $data_admissao)
    {
        $sql = "INSERT INTO funcionarios (nome, cpf, data_nasc, sexo, telefone, email, senha, endereco, bairro, cargo_id, data_admissao) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(
            "ssssssssssis",
            $nome, $cpf, $data_nasc, $sexo, $telefone, $email, $senha, $endereco_rua, $endereco_num, $endereco_bairro, $cargo_id, $data_admissao
        );

        return $stmt->execute();
    }
}
