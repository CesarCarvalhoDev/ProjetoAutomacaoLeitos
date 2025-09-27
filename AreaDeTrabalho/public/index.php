<?php
// Arquivo: AreaDeTrabalho/public/index.php

// 1. OBTENÇÃO E LIMPEZA DA URI

// Pega a URI completa solicitada. Ex: /GitHub/.../public/sobre?q=teste
$uri = $_SERVER['REQUEST_URI'] ?? '/';

// Define o prefixo do caminho completo do diretório 'public'
// Isso é o que vem antes da sua rota real: /GitHub/ProjetoAutomacaoLeitos/AreaDeTrabalho/public
$base_path = '/GitHub/ProjetoAutomacaoLeitos/AreaDeTrabalho/public';

// Remove a query string (ex: /sobre?q=teste -> /sobre)
$uri = strtok($uri, '?');

// Remove o prefixo do caminho do servidor da URI
// Isso transforma: /GitHub/.../public/sobre em /sobre
if (str_starts_with($uri, $base_path)) {
    $uri = substr($uri, strlen($base_path));
}

// Limpa barras iniciais e finais, exceto se for a raiz ('/')
if ($uri !== '/') {
    $uri = trim($uri, '/');
}

// Se a URI ficar vazia após a limpeza, é a página inicial
if (empty($uri)) {
    $uri = '/';
}


// 2. Variável de Controle e Roteamento (MANTIDO)
$page_file = 'pages/404.php'; 

switch ($uri) {
    case '/':
        // Rota para a Home (agora a URI limpa é apenas '/')
        $page_file = 'pages/home.php';
        break;

    case 'login':
        // Rota para a página Sobre (agora a URI limpa é 'sobre')
        $page_file = 'pages/login.php';
        break;

    // ... outras rotas
    
    default:
        // Qualquer outra rota não definida
        http_response_code(404);
        $page_file = 'pages/404.php';
        break;
}

// 3. Inclui o arquivo de Conteúdo
require_once $page_file;