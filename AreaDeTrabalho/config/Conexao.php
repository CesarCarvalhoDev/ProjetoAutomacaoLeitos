<?php
require_once __DIR__ . '/EnvLoader.php'; // Corrija esse caminho conforme necessário
EnvLoader::Load(__DIR__ . '/../../.env');

class Conexao
{
    private static $conn;

    public static function ConexaoBancoDeDados()
    {
        if (self::$conn === null) {
            $host = getenv("DB_HOST");
            $user = getenv("DB_USER");
            $password = getenv("DB_PASS");
            $database = getenv("DB_DATABASE");

            self::$conn = new mysqli($host, $user, $password, $database);

            if (self::$conn->connect_error) {
                throw new Exception("Erro ao conectar ao banco de dados: " . self::$conn->connect_error);
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
