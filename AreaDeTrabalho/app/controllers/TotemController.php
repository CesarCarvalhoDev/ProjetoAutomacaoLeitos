<?php
require_once __DIR__ . '/../models/Leitos.php';
require_once __DIR__ . '/../models/Paciente.php';
require_once __DIR__ . '/../models/Pedido.php';

class TotemController
{
    public function index()
    {
        require_once __DIR__ . '/../views/LoginLeito.php';
    }

    public function ViewHomePedido()
    {
        require_once __DIR__ . '/../views/pedido.php';
    }

    public function ProcessarFormLogin()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $num_leito = $_POST['num_leito'];

            $leito = new Leitos;
            $leito_logado = $leito->Login($num_leito);

            if ($leito_logado) {
                header("Location: /Home");
                exit;
            } else {
                echo "<script>alert('Número de leito inválido');</script>";
                header("Location: /");
                exit;
            }
        }
    }

    public function ProcessarFormRequisicao()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $id_paciente = $_POST['id_paciente'];
            $id_setor = $_POST['id_setor'];
            $tipo_pedido = $_POST['tipo_pedido'];
            $descricao = $_POST['descricao'];

            $pedido = new Pedido();

            $novo_pedido = $pedido->Criar($tipo_pedido,$descricao,$id_paciente,$id_setor);
            
            if($novo_pedido){
                header("Location: /Home/submit/success");
                exit;
            }
        }
    }
}
