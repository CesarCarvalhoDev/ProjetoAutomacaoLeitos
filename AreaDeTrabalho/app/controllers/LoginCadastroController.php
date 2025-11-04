<?php 
require_once("../models/Funcionario.php");

class LoginController
{
    
    public function MostrarViewLogin(){
        require_once __DIR__ . '/../views/login.php';
    }

    public function ProcessarFormLogin(){
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
        }
        }
}


?>

<?php 






}



?>