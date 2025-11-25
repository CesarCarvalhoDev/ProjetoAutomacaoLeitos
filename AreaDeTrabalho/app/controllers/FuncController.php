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

    public function ViewPedidos()
    {

        $usuario = $_SESSION['funcionario'];

        $pedido = new Pedido;
        $pedidos = $pedido->ExibirPedidosSetor($usuario['setor_id']);
        $minhas_requisicoes = $pedido->ExibirPedidosFunc($usuario['id_func']);

        require_once __DIR__ . "/../views/vizualizarPedido.php";
    }


    public function ProcessarAcaoPedido()
    {
        
        $response = ['status' => 'error', 'message' => 'Erro desconhecido no processamento.'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            
            if (!isset($_SESSION['funcionario'])) {
                $response['message'] = 'Funcionário não autenticado. Sessão expirada ou ausente.';
                goto output_json;
            }

            $usuario = $_SESSION['funcionario'];

            if (!isset($_POST['id_pedido']) || !isset($_POST['acao']) || !isset($usuario['id_func'])) {
                $response['message'] = 'Dados incompletos para processamento (POST ou ID do funcionário).';
                goto output_json;
            }

            $id_pedido = (int)$_POST['id_pedido'];
            $acao = $_POST['acao'];
            $id_func = $usuario['id_func']; 

            try {
                
                $pedidoModel = new Pedido();

                if ($acao === 'atender') {
                    $pedidoModel->AtribuirPedido($id_pedido, $id_func);
                    $response = ['status' => 'success', 'message' => 'Pedido atribuído com sucesso! Status: Em atendimento.'];
                } elseif ($acao === 'concluir') {
                    $pedidoModel->ConcluirPedido($id_pedido);
                    $response = ['status' => 'success', 'message' => 'Pedido concluído com sucesso! Status: Concluído.'];
                } else {
                    $response['message'] = 'Ação inválida especificada.';
                }
            } catch (\Exception $e) {
                
                $response['message'] = 'Erro ao processar o pedido: ' . $e->getMessage();
            }
        } else {
            $response['message'] = 'Método não permitido.';
        }

        output_json:

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}


