<?php  
require_once __DIR__ . '/../models/Funcionario.php';
require_once __DIR__ . '/../models/Setor.php';
require_once __DIR__ . '/../models/Cargo.php';
require_once __DIR__ . '/../models/Leitos.php';

class AdminController
{
    public function ViewAdmin()
    {
        require_once __DIR__ . '/../views/Admin.php';
    }

    public function ViewLogin()
    {
        require_once __DIR__ . '/../views/login.php';
    }

    public function ViewCadastroSetor()
    {
        require_once __DIR__ . '/../views/CadastroSetor.php';
    }
    public function ViewCadastroFuncionario()
    {
        $cargos = new Cargo();
        $cargos_cadastrados = $cargos->ExibirCargosCadastrados();

        require_once __DIR__ . '/../views/CadastroFunc.php';
        
    }

    public function ViewCadastroLeito()
    {
        $setores = new Setor();
        $setores_cadastrados = $setores->ExibirSetores();

        require_once __DIR__ . '/../views/CadastroLeito.php';
    }

    public function ProcessarFormLogin()
    {
        if (isset($_POST['acao']) && $_POST['acao'] === 'login') {

            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $funcionario = new Funcionario();
            $usuario = $funcionario->Login($email, $senha);

            if ($usuario) {
                session_start();
                $_SESSION['funcionario'] = $usuario;

                echo("<script>
                        alert('Login realizado com sucesso!');
                      </script>"
                    );
            } else {
                echo("<script>
                        alert('Email ou senha incorretos!');
                        window.history.back();
                      </script>"
            );
            }
        }
    }

    public function ProcessarFormCadastroFunc(){
        if($_SERVER['REQUEST_METHOD'] === "POST" ){
            $nome = $_POST['nome'];
            $sexo = $_POST['sexo'];
            $idade = $_POST['idade'];
            $data_adimisao = $_POST['data_adimisao'];
            $cargo_id = $_POST['cargo'];

            $funcionario = new Funcionario();

            $cadastro_func = $funcionario->Cadastrar($nome,$sexo,$idade,$data_adimisao,$cargo_id);
            if($cadastro_func){
                echo("<script>alert('Funcionário cadastrado com sucesso!');</script>");
            } else {
                echo("<script>alert('Erro ao cadastrar funcionario');</script>");
            }
        }
    }

    public function ProcessarFormCadastroSetor()
    {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nome = $_POST['nome'] ?? null;

                if (empty($nome)) {
                    die('O campo nome é obrigatório.');
                }

                $setor = new Setor();
                $cadastrar_setor = $setor->Cadastrar($nome);

                if($cadastrar_setor){
                    echo("<script>alert('Setor cadastrado com sucesso!');</script>");
                } else {
                    die('Método inválido. Use POST.');
                }
            }
    }
    
    public function ProcessarFormCadastroLeito(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $num_leito = $_POST['numero_do_leito'];
            $id_setor = $_POST['setor'];

            $leito = new Leitos;
            $status_leito_default = "Livre";
            $cadastro_leito = $leito->Cadastrar($num_leito,$id_setor,$status_leito_default);
            if($cadastro_leito){
                echo("<script>alert('Leito cadastrado com sucesso!');</script>");
            } else {
                echo("<script>alert('Erro ao cadastrar');</script>");
            }
        }
    }

    
}
?>
