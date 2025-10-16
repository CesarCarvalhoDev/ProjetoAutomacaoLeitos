<?php
// Arquivo: AreaDeTrabalho/public/index.php

// ===============================================
// 1. OBTENÇÃO E LIMPEZA DA URI
// ===============================================

// Pega a URI da requisição (ex: /, /login, /qualquer-outra)
$uri = $_SERVER['REQUEST_URI'] ?? '/';

// Remove a query string (ex: /login?user=1 → /login)
$uri = strtok($uri, '?');

// Limpa barras no início/fim (mantém apenas '/' se for raiz)
if ($uri !== '/') {
    $uri = trim($uri, '/');
}

// Se vazio, define como página inicial
if (empty($uri)) {
    $uri = '/';
}

// ===============================================
// 2. ROTEAMENTO
// ===============================================

// Caminho padrão (404)
$page_file = __DIR__ . '../pages/404.php';

switch ($uri) {
    case '/':
        $page_file = __DIR__ . '../pages/home.php';
        break;

    case 'login':
        $page_file = __DIR__ . '../pages/login.php';
        break;

    // outras rotas podem ser adicionadas aqui...

    default:
        http_response_code(404);
        $page_file = __DIR__ . '../pages/404.php';
        break;
}

// ===============================================
// 3. INCLUSÃO DA PÁGINA
// ===============================================
require_once $page_file;
