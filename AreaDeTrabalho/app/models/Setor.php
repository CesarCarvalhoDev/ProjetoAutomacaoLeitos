<?php 

require_once __DIR__ . '/../../config/Conexao.php';

/**
 * Setor
 */
class Setor
{
    private $conn; 

    public function __construct() {
        $this->conn = Conexao::ConexaoBancoDeDados();
    }
    
    /**
     * Cadastrar
     *
     * @param  mixed $nome
     * @return void
     */
    public function Cadastrar(string $nome)
    {
        $sql = "INSERT INTO setores (nome) VALUES (?)";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Erro ao preparar statement: " . $this->conn->error);
        }

        $stmt->bind_param("s", $nome);

        if ($stmt->execute()) {
            return "Cadastro realizado com sucesso!";
        } else {
            return "Erro ao cadastrar: " . $stmt->error;
        }
    }
    
    /**
     * ExibirSetores
     *
     * @return void
     */
    public function ExibirSetores()
    {
        $sql = "SELECT * FROM setores";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
