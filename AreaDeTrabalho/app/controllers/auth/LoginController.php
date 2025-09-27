<?php
session_start();

require_once __DIR__ . '/../../../app/models/Funcionario.php';

class LoginController
{
    public function loginForm()
    {
        require __DIR__ . '/../../views/Auth/Login.php';
    }

    public function login()
    {
        $email = $_POST['usuario'] ?? '';
        $senha = $_POST['senha'] ?? '';

        $funcionario = new Funcionario();
        $user = $funcionario->LoginFuncionario($email, $senha);

        if ($user) {
            $_SESSION['user'] = $user;
            echo "Login realizado com sucesso! Bem-vindo, " . $user['nome'];
        } else {
            echo "Usuário ou senha inválidos!";
        }
    }
}
