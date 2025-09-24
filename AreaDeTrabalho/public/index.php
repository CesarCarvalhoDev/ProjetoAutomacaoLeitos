<?php
session_start();

// Carrega Controller
require_once __DIR__ . '/../app/controllers/Auth/LoginController.php';

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($url) {
    case '/login':
        $controller = new LoginController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->login();
        } else {
            $controller->loginForm();
        }
        break;

    case '/':
        header("Location: /login");
        break;

    default:
        http_response_code(404);
        echo "404 - Página não encontrada";
        break;
}
