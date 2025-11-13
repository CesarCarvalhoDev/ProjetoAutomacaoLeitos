<?php 

require_once __DIR__ . '/../../config/Conexao.php';

/**
 * Leitos
 */
class Leitos
{
    private $conn;

    public function __construct()
    {
        $this->conn = Conexao::ConexaoBancoDeDados();
    }
    
    /**
     * Cadastrar
     *
     * @param  mixed $num_leito
     * @param  mixed $id_setor
     * @param  mixed $status_leito
     * @return void
     */
    public function Cadastrar($num_leito, $id_setor, $status_leito)
    {
        $sql = "INSERT INTO leitos (num_leito, id_setor, status_leito) VALUES (?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Erro ao preparar statement: " . $this->conn->error);
        }

        
        $stmt->bind_param("iis", $num_leito, $id_setor, $status_leito);

        if ($stmt->execute()) {
            return "Cadastro Realizado com sucesso!";
        } else {
            return "Erro ao cadastrar: " . $stmt->error;
        }
    }
    
    public function ExibirInfo() 
    {
        $sql = "SELECT leitos.id, leitos.num_leito, setores.nome AS nome_setor
                FROM leitos
                JOIN setores ON setores.id = leitos.id_setor";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
         
    /**
     * AlocarPaciente
     *
     * @param  mixed $id_leito
     * @return bool
     */
    public function AlocarPaciente(int $id_leito): bool 
    {
        $sql = "UPDATE leitos SET status_leito = 'Ocupado' WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_leito);

        return $stmt->execute();
    }

}

?>
