<?php  

/************************************************************************/
/* SysFramework - PHP Framework                                         */
/* ============================                                         */
/*                                                                      */
/* PHP Framework                                                        */
/* (c) 2025 by Marco Costa marcocosta@gmx.com                           */
/*                                                                      */
/* https://sysframework.com                                             */
/*                                                                      */
/* This project is licensed under the MIT License.                      */
/*                                                                      */
/* For more informations: marcocosta@gmx.com                            */
/************************************************************************/

namespace Core;

class SysEnv
{
    /**
     * Carrega as variáveis de ambiente do arquivo .env.
     *
     * @param string $filePath Caminho para o arquivo .env.
     */
    public static function load($filePath = __DIR__ . '/../.env')
    {
        if (!file_exists($filePath)) {
            throw new \Exception("Arquivo .env não encontrado em: " . $filePath);
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // Ignorar comentários
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            // Dividir chave e valor
            list($key, $value) = explode('=', $line, 2) + [NULL, NULL];

            if ($key !== NULL) {
                $key = trim($key);
                $value = trim($value);

                // Definir variável de ambiente
                putenv("$key=$value");
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
            }
        }
    }

    /**
     * Obtém o valor de uma variável de ambiente.
     *
     * @param string $key Nome da variável.
     * @param mixed $default Valor padrão se a variável não existir.
     * @return mixed Valor da variável de ambiente ou o valor padrão.
     */
    public static function get($key, $default = null)
    {
        return $_ENV[$key] ?? $_SERVER[$key] ?? $default;
    }
}

?>