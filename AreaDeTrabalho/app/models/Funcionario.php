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
        $sql = "SELECT  
                funcionarios.id AS id_func,
                funcionarios.nome AS nome_func,
                funcionarios.sexo,
                funcionarios.idade,
                funcionarios.data_admissao,
                funcionarios.cargo_id,
                funcionarios.email,
                funcionarios.senha,
                funcionarios.setor_id,
                setores.nome AS nome_setor,
                cargos.descricao AS descricao_cargo
                FROM funcionarios
                INNER JOIN setores 
                    ON setores.id = funcionarios.setor_id
                INNER JOIN cargos 
                    ON cargos.id = funcionarios.cargo_id
                WHERE funcionarios.email = ?
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();

        if ($usuario && $senha === $usuario['senha']) {
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

    public function ExibirInfoFunc($id_)
    {
        $sql = "SELECT  
            id as id_func,
            nome as nome_func,
            sexo,
            idade,
            data_admissao,
            cargo_id,
            email,
            senha,
            setor_id,
            setores.nome as nome_setor,
            cargos.descricao as descricao_cargo
            FROM funcionarios
            INNER JOIN setores ON setores.id = funcionarios.setor_id
            INNER JOIN cargos ON cargos.id = funcionarios.cargo_id
            WHERE id_func = ?
        ";
    }
}

/*
$funcionario = new Funcionario;
$usuario = $funcionario->Login("teste2@gmail.com", "1234");

if ($usuario) {
    foreach ($usuario as $campo => $valor) {
        echo $campo . ": " . $valor . "\n";
    }
} else {
    echo "Usuário não encontrado ou senha incorreta.";
}
*/
