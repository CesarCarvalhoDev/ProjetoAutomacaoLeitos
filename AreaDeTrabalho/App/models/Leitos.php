<?php 

class Leitos
{
    public function __construct()
    {
        $this->conn = Conexao::ConexaoBancoDeDados();
    }

    public function CadastrarLeito($num_leito,$num_invetario,$status_leito)
    {
        $sql = "INSERT INTO (num_leito, num_inventario, status_leito) VALUES (?,?,?)";
        $stmt = $this->conn->preprare($sql);
        $stmt->bindValue(
            "iis",
            $num_leito,
            $num_inventario,
            $status_leito
        );
        return $stmt->execute() ? "Cadastro Realizado" : "Erro ao Cadastrar";
    }

}


?>