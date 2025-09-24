<?php

namespace Core;

class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = [];
    }

    public function loadView(string $viewName, array $viewData = []): void
    {
        extract($viewData);
        $this->view = $viewData;
        require_once __DIR__ . '/../views/' . $viewName . '.php';
    }

    public function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }
}