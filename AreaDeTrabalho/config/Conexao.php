<?php
require_once __DIR__ . '/../../core/EnvLoader.php';
EnvLoader::Load(__DIR__ . '/../../.env');

class Conexao
{
    private static $conn;

    public static function ConexaoBancoDeDados()
    {
        if (self::$conn === null) {
            $host = $_ENV["DB_HOST"];
            $user = $_ENV['DB_USER'];
            $password = $_ENV['DB_PASS'];
            $database = $_ENV['DB_DATABASE'];

            self::$conn = new mysqli($host, $user, $password, $database);

            if (self::$conn->connect_error) {
                die("Erro ao conectar ao banco de dados: " . self::$conn->connect_error);
            }

            self::$conn->set_charset("utf8mb4");
        }

        return self::$conn;
    }

    public static function FecharConexao()
    {
        if (self::$conn !== null) {
            self::$conn->close();
            self::$conn = null;
        }
    }
}
