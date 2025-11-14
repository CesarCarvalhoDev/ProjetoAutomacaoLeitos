<?php
// Arquivo: config/routes.php

return [
    '/' => 'TotemController@index',
    'Login/submit' => 'TotemController@ProcessarFormLogin',
    'Home' => 'TotemController@ViewHomePedido',
    'Admin'=> 'AdminController@ViewAdmin',
    'admin/login' => 'AdminController@ViewLogin',
    'admin/login/submit'=>'AdminController@ProcessarFormLogin',
    'Admin/Setor/Cadastro'=>'AdminController@ViewCadastroSetor',
    'Admin/Setor/Cadastro/submit'=>'AdminController@ProcessarFormCadastroSetor',
    'Admin/Funcionario/Cadastro'=>'AdminController@ViewCadastroFuncionario',
    'Admin/Funcionario/Cadastro/submit'=>'AdminController@ProcessarFormCadastroFunc',
    'Admin/Leito/Cadastro'=>'AdminController@ViewCadastroLeito',
    'Admin/Leito/Cadastro/submit' => 'AdminController@ProcessarFormCadastroLeito',
    'Admin/Paciente/Cadastro' => 'AdminController@ViewCadastroPaciente',
    'Admin/Paciente/Cadastro/submit' => 'AdminController@ProcessarFormCadastroPaciente',
    
];

