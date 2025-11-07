<?php  
require_once __DIR__ . '/../models/Funcionario.php';

class LoginController
{
    public function MostrarViewLogin()
    {
        require_once __DIR__ . '/../views/login.php';
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

                echo "<script>
                        alert('Login realizado com sucesso!');
                        window.location.href = '../home';
                      </script>";
            } else {
                echo "<script>
                        alert('Email ou senha incorretos!');
                        window.history.back();
                      </script>";
            }
        }
    }
}
?>
