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
 * SysORMRequest - simple request data collector and validator
 * - Collects request data (POST by default)
 * - Supports basic rule-based validation
 */
class SysORMRequest
{
    /**
     * @var array Request data
     */
    protected array $data;

    /**
     * Constructor - load request data (POST by default)
     */
    public function __construct()
    {
        $this->data = $_POST; // Can be replaced with $_GET or custom array if needed
    }

    /**
     * Define validation rules for request fields
     * Example: ['email' => 'required', 'age' => 'numeric']
     *
     * @return array Associative array: ['field_name' => 'rule']
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Validate the request data against the rules
     *
     * @throws \Exception if a required field is missing or empty
     */
    public function validate(): void
    {
        $rules = $this->rules();
        foreach ($rules as $field => $rule) {
            if ($rule === 'required' && ( !isset($this->data[$field]) || $this->data[$field] === '' )) {
                throw new \Exception("The field '{$field}' is required.");
            }

            // Additional validation rules can be added here (e.g., numeric, email, min/max length)
        }
    }

    /**
     * Return validated data after checking rules
     *
     * @return array Validated request data
     */
    public function validated(): array
    {
        $this->validate();
        return $this->data;
    }

    /**
     * Magic getter to access individual request fields
     *
     * @param string $name Field name
     * @return mixed|null Field value or null if not present
     */
    public function __get(string $name)
    {
        return $this->data[$name] ?? null;
    }
}
