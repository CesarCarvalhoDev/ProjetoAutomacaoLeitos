<?php 
class Paciente
{

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function Cadastrar($cpf,$nome,$sexo,$idade,$num_leito,$cracha_medico)
    {
        $sql = "INSERT INTO pacientes(cpf,nome,sexo,idade,num_leito,cracha) VALUES(:cpf,:nome,:sexo,:idade,:num_leito,:cracha_medico)";
        $stmt = $this->$conn->prepare($sql);
        $stmt->bindValue(":cpf", $cpf);
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":sexo", $sexo);
        $stmt->bindValue(":idade", $idade);
        $stmt->bindValue(":num_value", $num_leito);
        $stmt->bindValue(":cracha_medico", $cracha_medico);

        return $stmt->execute();
    }
}

?>