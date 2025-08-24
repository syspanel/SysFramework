<?php

namespace Core;

use Core\SysORMHash;

class SysORMAuth {
    public static function attempt(array $credentials) {
        $user = User::where('email', $credentials['email'])->first(); // Supondo que você tenha um método where

        if ($user && SysORMHash::check($credentials['password'], $user->password)) {
            $_SESSION['user_id'] = $user->id; // Armazena o ID do usuário na sessão
            return true;
        }

        return false;
    }

    public static function logout() {
        session_destroy(); // Destrói a sessão do usuário
    }

    public static function user() {
        if (isset($_SESSION['user_id'])) {
            return User::find($_SESSION['user_id']);
        }
        return null;
    }
}
