<?php

namespace App\Services;

use App\Models\User;
use Core\SysORMHash;
use Core\SysORMAuth;

class AuthService {
    public function attempt(array $credentials) {
        return Auth::attempt($credentials);
    }

    public function logout() {
        Auth::logout();
    }

    public function user() {
        return Auth::user();
    }

    public function register(array $data) {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function recoverPassword($email) {
        // Lógica para enviar e-mail de recuperação de senha
    }

    public function confirmRegistration($token) {
        // Lógica para confirmar o registro usando o token
    }
}
