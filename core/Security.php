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

class Security
{
    /**
     * Sanitiza uma string removendo tags HTML e caracteres especiais.
     *
     * @param string $value
     * @return string
     */
    public static function sanitize($value)
    {
        return htmlspecialchars(strip_tags($value), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Sanitiza uma string para prevenir injeções SQL.
     *
     * @param string $value
     * @return string
     */
    public static function escapeSql($value)
    {
        // Este método depende da biblioteca de banco de dados utilizada.
        // Exemplo com PDO:
        return $value; // Usar prepared statements em vez de escapar manualmente.
    }

    /**
     * Gera um token CSRF e o armazena na sessão.
     *
     * @return string
     */
    public static function generateCsrfToken()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Valida um token CSRF.
     *
     * @param string $token
     * @return bool
     */
    public static function validateCsrfToken($token)
    {
        return hash_equals($_SESSION['csrf_token'] ?? '', $token);
    }

    /**
     * Protege contra ataques de Cross-Site Scripting (XSS).
     *
     * @param string $value
     * @return string
     */
    public static function escapeHtml($value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Valida uma URL para garantir que seja segura.
     *
     * @param string $url
     * @return bool
     */
    public static function validateUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }
}
