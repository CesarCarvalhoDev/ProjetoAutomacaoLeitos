<?php

require_once __DIR__ . '/../../config/Conexao.php';

/**
 * Funcionario
 */
class Funcionario
{
    private $conn;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->conn = Conexao::ConexaoBancoDeDados();
    }

    public function Login($email, $senha)
    {
        $sql = "SELECT * FROM funcionarios WHERE email = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        return null;
    }

        
    /**
     * Cadastrar
     *
     * @param  mixed $nome
     * @param  mixed $sexo
     * @param  mixed $idade
     * @param  mixed $data_admissao
     * @param  mixed $cargo_id
     * @param  mixed $setor_id
     * @return void
     */
    public function Cadastrar(string $nome, string  $sexo, int  $idade, string $data_admissao, int $cargo_id, int $setor_id, string $email, string $senha)
    {
        $sql = "INSERT INTO funcionarios (nome, sexo, idade, data_admissao, cargo_id,setor_id, email, senha) 
                VALUES (?,?,?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Erro ao preparar statement: " . $this->conn->error);
        }

        $stmt->bind_param("ssisiiss", $nome, $sexo, $idade, $data_admissao, $cargo_id, $setor_id, $email, $senha);

        return $stmt->execute() ? "Cadastro Realizado" : "Erro ao Cadastrar: " . $stmt->error;
    }

    public function ExibirMedicos()
    {
        $sql = 
        "SELECT 
        funcionarios.id,
        funcionarios.nome,
        funcionarios.sexo,
        funcionarios.idade,
        funcionarios.data_admissao,
        funcionarios.cargo_id,
        funcionarios.setor_id
        FROM funcionarios 
        INNER JOIN cargos ON cargos.id = funcionarios.cargo_id
        WHERE cargos.descricao LIKE '%Medico%'";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
