<?php
require_once __DIR__ . '/../models/Leitos.php';

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
}
