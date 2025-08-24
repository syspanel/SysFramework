<?php

namespace Core;

class SysORMRequest {
    protected $data;

    public function __construct() {
        $this->data = $_POST; // ou $_GET, conforme necessário
    }

    public function rules() {
        return [];
    }

    public function validate() {
        $rules = $this->rules();
        foreach ($rules as $field => $rule) {
            // Implemente sua lógica de validação aqui
            if (isset($this->data[$field]) && empty($this->data[$field])) {
                throw new \Exception("O campo {$field} é obrigatório.");
            }
        }
    }

    public function validated() {
        $this->validate();
        return $this->data; // Retornar dados validados
    }

    public function __get($name) {
        return $this->data[$name] ?? null;
    }
}
