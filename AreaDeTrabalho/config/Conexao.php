<?php
require_once __DIR__ . '/EnvLoader.php';

class Conexao
{
    private static $conn = null;

    public static function ConexaoBancoDeDados()
    {
        if (self::$conn === null) {

            
            $envPath = __DIR__ . '/.env';

            
            if (!isset($_ENV['HOST'])) {
                EnvLoader::Load($envPath);
            }

            
            $host = getenv('HOST');
            $usuario = getenv('USER');
            $senha = getenv('PASS');
            $banco = getenv('DATABASE');
            $porta = getenv('PORT') ?: 3306; 

            
            self::$conn = new mysqli($host, $usuario, $senha, $banco, $porta);

            
            if (self::$conn->connect_error) {
                die('Erro de conexão: ' . self::$conn->connect_error);
            }
        }

        return self::$conn;
    }
}
?>
