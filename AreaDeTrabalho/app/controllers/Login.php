<?php 
session_start();
require '../class/Conexao.php';
require '../class/Funcionario.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $conn = Conexao::ConexaoBancoDeDados();

    $funcionario = new Funcionario($conn);
    $resultado = $funcionario->LoginFuncionario($email, $senha);

    if ($resultado) {
        $_SESSION['funcionario'] = $resultado;
        header("Location: dashboard.php");
        exit;
    } else {
        echo("erro ao logar");
        header("Location: login.php?erro=1");
        exit;
    }

    $conn = Conexao::FecharConexao();
}
?>