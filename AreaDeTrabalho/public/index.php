<?php
// Arquivo: public/index.php

// 1. Incluindo o arquivo de rotas
$routes = include __DIR__ . '/../config/routes.php';  // Carrega as rotas definidas

// 2. OBTENÇÃO E LIMPEZA DA URI
$uri = $_SERVER['REQUEST_URI'] ?? '/';  // Pega a URI da requisição
$uri = strtok($uri, '?'); // Remove query string, se houver
$uri = trim($uri, '/');    // Limpa as barras no início e no final

// Se a URI estiver vazia, define como a página inicial
if (empty($uri)) {
    $uri = '/';
}

// 3. ROTEAMENTO
// Verifica se a URI existe no array de rotas
if (isset($routes[$uri])) {
    // Pega o controlador e método a partir da string 'Controlador@Método'
    list($controllerName, $methodName) = explode('@', $routes[$uri]);

    // Verifica se o controlador existe
    $controllerPath = __DIR__ . '/../app/controllers/' . $controllerName . '.php';
    if (file_exists($controllerPath)) {
        // Inclui o controlador
        require_once $controllerPath;

        // Instancia o controlador
        $controller = new $controllerName();

        // Verifica se o método existe no controlador
        if (method_exists($controller, $methodName)) {
            // Chama o método do controlador
            $controller->$methodName();
        } else {
            // Caso o método não exista, retorna 404
            http_response_code(404);
            echo "Método '$methodName' não encontrado.";
        }
    } else {
        // Caso o controlador não exista, retorna 404
        http_response_code(404);
        echo "Controlador '$controllerName' não encontrado.";
    }
} else {
    // Se a URI não estiver nas rotas, mostra a página 404
    http_response_code(404);
    require_once __DIR__ . '/../app/views/404.php';  // Página de erro 404
}
