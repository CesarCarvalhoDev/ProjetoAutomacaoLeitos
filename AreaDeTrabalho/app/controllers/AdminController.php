<?php
require_once __DIR__ . '/../models/Funcionario.php';
require_once __DIR__ . '/../models/Setor.php';
require_once __DIR__ . '/../models/Cargo.php';
require_once __DIR__ . '/../models/Leitos.php';
require_once __DIR__ . '/../models/Paciente.php';

class AdminController
{
    public function ViewAdmin()
    {
        if (empty($_SESSION['funcionario'])) {
            header('Location: /Admin/Login');
            exit;
        } else {
            require_once __DIR__ . '/../views/Admin.php';
        }
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
        $setores = new Setor();
        $setores_cadastrados = $setores->ExibirSetores();

        require_once __DIR__ . '/../views/CadastroFunc.php';
    }

    public function ViewCadastroLeito()
    {
        $setores = new Setor();
        $setores_cadastrados = $setores->ExibirSetores();

        require_once __DIR__ . '/../views/CadastroLeito.php';
    }

    public function ViewCadastroPaciente()
    {
        $leito = new Leitos();
        $leitos_cadastrados = $leito->ExibirInfo();

        $funcionario = new Funcionario();
        $medicos_cadastrados = $funcionario->ExibirMedicos();

        require_once __DIR__ . '/../views/CadastroPaciente.php';
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
                if ($usuario['cargo_id'] == 7) {
                    header("Location: Admin");
                    exit();
                } else {
                    header("Location: Dashboard");
                    exit();
                }
            }
        }
    }

    public function ProcessarFormCadastroFunc()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $nome = $_POST['nome'];
            $sexo = $_POST['sexo'];
            $idade = $_POST['idade'];
            $data_adimisao = $_POST['data_adimisao'];
            $cargo_id = $_POST['cargo'];
            $setor_id = $_POST['setor'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $funcionario = new Funcionario();

            $cadastro_func = $funcionario->Cadastrar($nome, $sexo, $idade, $data_adimisao, $cargo_id, $setor_id, $email, $senha);
            if ($cadastro_func) {
                echo ("<script>alert('Funcionário cadastrado com sucesso!');</script>");
            } else {
                echo ("<script>alert('Erro ao cadastrar funcionario');</script>");
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

            if ($cadastrar_setor) {
                echo ("<script>alert('Setor cadastrado com sucesso!');</script>");
            } else {
                die('Método inválido. Use POST.');
            }
        }
    }

    public function ProcessarFormCadastroLeito()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $num_leito = $_POST['numero_do_leito'];
            $id_setor = $_POST['setor'];

            $leito = new Leitos;
            $status_leito_default = "Livre";
            $cadastro_leito = $leito->Cadastrar($num_leito, $id_setor, $status_leito_default);
            if ($cadastro_leito) {
                echo ("<script>alert('Leito cadastrado com sucesso!');</script>");
            } else {
                echo ("<script>alert('Erro ao cadastrar');</script>");
            }
        }
    }

    public function ProcessarFormCadastroPaciente()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $sexo = $_POST['sexo'];
            $idade = $_POST['idade'];
            $id_leito = $_POST['leito'];
            $id_medico = $_POST['medico'];

            $paciente = new Paciente();
            $paciente_cadastrado = $paciente->Cadastrar($nome, $sexo, $idade, $id_leito, $id_medico);

            $leito = new Leitos();
            $leito_modificado = $leito->AlocarPaciente($id_leito);

            if ($paciente_cadastrado) {
                echo ("<script>alert('Paciente cadastrado com sucesso!');</script>");
            } else {
                echo ("<script>alert('Erro ao cadastrar paciente!');</script>");
            }
        }
    }
}
