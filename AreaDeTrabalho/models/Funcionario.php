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

    public function LoginFuncionario($email,$senha)
    {
        $sql = "SELECT * FROM funcionarios WHERE email=:email AND senha=:senha";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        $stmt->execute();
        If($stmt->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }
}



?>