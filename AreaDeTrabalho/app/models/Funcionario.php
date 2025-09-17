<?php 
class Funcionario
{
    public $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function CadastroFuncionario($nome,$cpf,$data_nasc,$sexo,$telefone,$email,$endereco_rua,$endereco_num,$endereco_bairro,$cargo_id,$data_adimicao){
        $sql = "INSERT INTO funcionarios(nome,cpf,data_nasc,sexo,telefone,email,endereco_rua,endereco_num,endereco_bairro,cargo_id,data_admissao)  VALUES (:nome,:cpf,:data_nasc,:sexo,:telefone,:email,:endereco_rua,:endereco_num,:endereco_bairro,:cargo_id,:data_admissao)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':data_nasc', $data_nasc);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':endereco_rua', $endereco_rua);
        $stmt->bindParam(':endereco_num', $endereco_num);
        $stmt->bindParam(':endereco_bairro', $endereco_bairro);
        $stmt->bindParam(':cargo_id', $cargo_id);
        $stmt->bindParam(':data_admissao', $data_adimicao);
        return $stmt->execute();
    }

    public function LoginFuncionario($email, $senha)
    {
    $sql = "SELECT * FROM funcionarios WHERE email = ? AND senha = ? LIMIT 1";
    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
        die("Erro na preparação da query: " . $this->conn->error);
    }

    $stmt->bind_param("ss", $email, $senha); // "ss" = dois parâmetros string
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        return $row; // retorna os dados do funcionário
    } else {
        return null; // login inválido
    }
    }
}



?>