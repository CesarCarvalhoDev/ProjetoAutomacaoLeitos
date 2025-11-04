<?php
// Arquivo: app/controllers/HomeController.php

class HomeController {
    public function index() {
        // Exibe a página inicial
        require_once __DIR__ . '/../views/home.php';
    }
}
