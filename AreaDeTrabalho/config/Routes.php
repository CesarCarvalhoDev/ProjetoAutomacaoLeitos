<?php
// Arquivo: config/routes.php

return [
    '/' => 'HomeController@index',           // Rota para a página inicial
    'login' => 'LoginController@MostrarViewLogin', // Rota para a página de login
    'login/submit'=>'LoginController@ProcessarFormLogin' 
    // Outras rotas podem ser adicionadas aqui conforme necessário
];