<?php
class Conexao
{
private static $host = "localhost";
private static $user = "CESARADM";
private static $password =  "rasen1063";
private static $database  = "teste_automacao";
public static $conn;

public static function ConexaoBancoDeDados()
{
    if(self::$conn === null)
    {
        self::$conn = new mysqli(self::$host,self::$user,self::$password, self::$database);

        if(self::$conn->connect_error){
            die("Erro ao connectar ao banco de dados");
            
        }
    }
    return self::$conn;
}

public static function FecharConexao()
{
    if(self::$conn != null)
    {
        self::$conn = self::$conn -> close();
    }
}

}
?>