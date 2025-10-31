<?php  

/***************************************************************************
 * SysFramework - PHP Framework                                            *
 * ======================================================================= *
 *                                                                          *
 * PHP Framework                                                            *
 * (c) 2025 Marco Costa  |  sysframework@syspanel.com.br                    *
 * Website: https://sysframework.syspanel.com.br                            *
 *                                                                          *
 * Licensed under the MIT License                                           *
 *                                                                          *
 * Permission is hereby granted, free of charge, to any person obtaining    *
 * a copy of this software and associated documentation files (the          *
 * "Software"), to deal in the Software without restriction, including      *
 * without limitation the rights to use, copy, modify, merge, publish,      *
 * distribute, sublicense, and/or sell copies of the Software, and to       *
 * permit persons to whom the Software is furnished to do so, subject to    *
 * the following conditions:                                                *
 *                                                                          *
 * The above copyright notice and this permission notice shall be included  *
 * in all copies or substantial portions of the Software.                   *
 *                                                                          *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS  *
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF               *
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.   *
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY     *
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,     *
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE        *
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.                   *
 ***************************************************************************/

namespace Core;

/**
 * Validations class for input validation
 *
 * Technical comments:
 * - Supports simple rules (e.g., required, email)
 * - Supports complex rules (e.g., length constraints)
 * - Stores errors per field
 * - Provides methods to check and retrieve errors
 */
class Validations
{
    protected $errors = []; // Array to store validation errors

    /**
     * Validate data based on rules
     *
     * @param array $data Input data to validate
     * @param array $rules Validation rules per field
     */
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

    /**
     * Apply simple validation rules (e.g., required, email)
     *
     * @param string $field Field name
     * @param mixed $value Field value
     * @param string $rule Rule name
     */
    protected function applySimpleRule($field, $value, $rule)
    {
        switch ($rule) {
            case 'required':
                if (empty($value)) {
                    $this->addError($field, 'The field is required.');
                }
                break;
            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, 'The email is invalid.');
                }
                break;
            // Additional simple rules can be added here
        }
    }

    /**
     * Apply complex validation rules (e.g., length constraints)
     *
     * @param string $field Field name
     * @param mixed $value Field value
     * @param array $rule Rule configuration
     */
    protected function applyRule($field, $value, array $rule)
    {
        if (isset($rule['length'])) {
            $length = strlen($value);
            if ($length < $rule['length'][0] || $length > $rule['length'][1]) {
                $this->addError($field, "The field must be between {$rule['length'][0]} and {$rule['length'][1]} characters.");
            }
        }
        // Additional complex rules can be implemented here
    }

    /**
     * Add an error message for a specific field
     *
     * @param string $field Field name
     * @param string $message Error message
     */
    protected function addError($field, $message)
    {
        $this->errors[$field][] = $message;
    }

    /**
     * Check if any validation errors exist
     *
     * @return bool True if errors exist, false otherwise
     */
    public function hasErrors()
    {
        return !empty($this->errors);
    }

    /**
     * Get all validation errors
     *
     * @return array Array of errors per field
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
