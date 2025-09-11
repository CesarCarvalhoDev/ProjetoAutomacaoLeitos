<?php 
session_start();
require '../classes/Conexao.php';
require '../classes/Funcionario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $funcionario = new Funcionario($conn);
    $resultado = $funcionario->LoginFuncionario($email, $senha);

    if ($resultado) {
        $_SESSION['funcionario'] = $resultado;
        header("Location: dashboard.php");
        exit;
    } else {
        header("Location: login.php?erro=1");
        exit;
    }
}


?>