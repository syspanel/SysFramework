<?php

namespace App\Requests;

use SysORM\Request; // Supondo que você tenha uma classe de Request no SysORM

class UserRequest extends Request {
    public function rules() {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . ($this->user() ? $this->user()->id : ''),
            'password' => 'required|string|min:8|confirmed',
            // Adicione outras regras conforme necessário
        ];
    }

    public function authorize() {
        return true; // Permitir acesso para todos
    }

    public function validated() {
        return parent::validated(); // Retornar dados validados
    }
}
