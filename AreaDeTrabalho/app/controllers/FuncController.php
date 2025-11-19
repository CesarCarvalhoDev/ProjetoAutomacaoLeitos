<?php 
require_once __DIR__ . '/../models/Funcionario.php';
require_once __DIR__ . '/../models/Pedido.php';


class FuncController
{
    public function ViewLogin()
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
                if ($usuario['cargo_id'] <> 7) {
                    header("Location: /Func/Dashboard");
                    exit();
                } else {
                    header("Location: /Func/Login");
                    exit();
                }
            }
        }
    }

    public function ViewPedidos(){

        $usuario = $_SESSION['funcionario'];

        $pedido = new Pedido;
        $pedidos = $pedido->ExibirPedidosSetor($usuario['setor_id']);

        require_once __DIR__ . "/../views/vizualizarPedido.php";
    }

}

?>