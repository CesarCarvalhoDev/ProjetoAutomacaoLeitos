<?php
$routes = include __DIR__ . '/../config/routes.php';

// Captura o caminho completo (ex: /AreaDeTrabalho/public/Admin/Setor/Cadastro/submit)
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove a parte "/AreaDeTrabalho/public" do início
$basePath = '/AreaDeTrabalho/public';
if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

// Remove barras extras do começo e fim
$uri = trim($uri, '/');

// Se estiver vazio, define como rota inicial
if ($uri === '') {
    $uri = '/';
}

if (isset($routes[$uri])) {
    list($controllerName, $methodName) = explode('@', $routes[$uri]);
    $controllerPath = __DIR__ . '/../app/controllers/' . $controllerName . '.php';

    if (file_exists($controllerPath)) {
        require_once $controllerPath;
        $controller = new $controllerName();

        if (method_exists($controller, $methodName)) {
            $controller->$methodName();
        } else {
            http_response_code(404);
            echo "Método '$methodName' não encontrado.";
        }
    } else {
        http_response_code(404);
        echo "Controlador '$controllerName' não encontrado.";
    }
} else {
    http_response_code(404);
    require_once __DIR__ . '/../app/views/404.php';
}
