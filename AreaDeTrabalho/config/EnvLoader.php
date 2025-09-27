<?php 
class EnvLoader
{
    public static function Load($path)
    {
        if (!file_exists($path)) {
            throw new Exception('Erro ao carregar .env: arquivo não encontrado.');
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $line = trim($line);

            // Ignora comentários e linhas inválidas
            if (str_starts_with($line, '#') || strpos($line, '=') === false) {
                continue;
            }

            list($key, $value) = explode('=', $line, 2);

            $key = trim($key);
            $value = trim($value);

            // Remove aspas se existirem
            $value = trim($value, "'\"");

            // Define no ambiente
            putenv("$key=$value");
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}
?>
