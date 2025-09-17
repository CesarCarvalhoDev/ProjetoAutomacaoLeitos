<?php 
class EnvLoader
{
    public static function Load(string $path)
    {
        if (!file_exists($path)) {
            throw new Exception('.env file not found.');
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $line = trim($line);
            if (str_starts_with($line, '#') || strpos($line, '=') === false) {
                continue; // pula comentários ou linhas sem '='
            }

            list($key, $value) = explode('=', $line, 2);

            $key = trim($key);
            $value = trim($value);

            // Remove aspas simples ou duplas do valor
            $value = trim($value, "\"'");

            putenv("$key=$value");
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value; // opcional, pode ser útil
        }
    }
}
