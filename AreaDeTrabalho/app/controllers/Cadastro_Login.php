<?php 

require_once("../models/Funcionario.php");

$funcionario = new Funcionario();

if(isset($_POST['acao'])){
    $acao = $_POST['acao'];

    switch ($acao) {
        case 'login':
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $usuario = $funcionario->Login($email,$senha);
            
            if($usuario){
                session_start();
                $_SESSION['funcionario'] = $usuario;
                echo("<script>alert('Login realizado com sucesso!');");
            } else{
                echo("<script>alert('Erro ao logar');");
            }
        
        case 'cadastro':
            
    }
}



?>