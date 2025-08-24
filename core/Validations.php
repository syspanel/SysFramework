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

class Validations
{
    protected $errors = [];

    public function validate(array $data, array $rules)
    {
        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                if (is_array($rule)) {
                    $this->applyRule($field, $data[$field] ?? null, $rule);
                } else {
                    $this->applySimpleRule($field, $data[$field] ?? null, $rule);
                }
            }
        }
    }

    protected function applySimpleRule($field, $value, $rule)
    {
        switch ($rule) {
            case 'required':
                if (empty($value)) {
                    $this->addError($field, 'O campo é obrigatório.');
                }
                break;
            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, 'O e-mail é inválido.');
                }
                break;
            // Adicione mais regras conforme necessário
        }
    }

    protected function applyRule($field, $value, array $rule)
    {
        if (isset($rule['length'])) {
            $length = strlen($value);
            if ($length < $rule['length'][0] || $length > $rule['length'][1]) {
                $this->addError($field, "O campo deve ter entre {$rule['length'][0]} e {$rule['length'][1]} caracteres.");
            }
        }
        // Adicione mais regras complexas conforme necessário
    }

    protected function addError($field, $message)
    {
        $this->errors[$field][] = $message;
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
