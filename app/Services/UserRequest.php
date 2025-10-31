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

namespace App\Requests;

use SysORM\Request;

class UserRequest extends Request
{
    /**
     * Define validation rules for create/update.
     *
     * @return array
     */
    public function rules()
    {
        $userId = $this->user() ? $this->user()->id : null;

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'password' => $this->isUpdate() 
                ? 'nullable|string|min:8|confirmed'   // For update, password is optional
                : 'required|string|min:8|confirmed',  // For create, password is required
        ];
    }

    /**
     * Authorize the request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Adjust logic if only admins can update/create users
        return true;
    }

    /**
     * Determine if this is an update request.
     *
     * @return bool
     */
    protected function isUpdate()
    {
        return $this->method() === 'PUT' || $this->method() === 'PATCH';
    }

    /**
     * Return validated and sanitized data.
     *
     * @return array
     */
    public function validated()
    {
        $data = parent::validated();

        // Basic sanitization
        if (isset($data['name'])) {
            $data['name'] = trim($data['name']);
        }
        if (isset($data['email'])) {
            $data['email'] = strtolower(trim($data['email']));
        }
        if (isset($data['password']) && !empty($data['password'])) {
            // Hash password if provided
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        } else {
            // Remove empty password field during update
            unset($data['password']);
        }

        return $data;
    }
}
