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

class SysSanitize {
    // Método para remover tags HTML e codificar caracteres especiais
    public static function sanitizeString($string) {
        return htmlspecialchars(strip_tags($string), ENT_QUOTES, 'UTF-8');
    }

    // Método para sanitizar arrays recursivamente
    public static function sanitizeArray($array) {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = self::sanitizeArray($value);
            } else {
                $array[$key] = self::sanitizeString($value);
            }
        }
        return $array;
    }

    // Método para sanitizar inputs gerais (strings ou arrays)
    public static function sanitize($input) {
        if (is_array($input)) {
            return self::sanitizeArray($input);
        }
        return self::sanitizeString($input);
    }
}

?>