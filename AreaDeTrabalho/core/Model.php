<?php
namespace Core;

use mysqli;
use Exception;

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Erro de conexão: " . $this->db->connect_error);
        }
        $this->db->set_charset("utf8mb4");
    }
}
