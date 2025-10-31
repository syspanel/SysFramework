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
 * SysORMHash - simple wrapper for password hashing and verification
 * - Uses PHP's built-in password_hash() and password_verify()
 * - Abstracts hashing logic for the SysORMAuth system
 */
class SysORMHash
{
    /**
     * Generate a secure hash for a given value
     *
     * @param string $value Plain text value
     * @return string Hashed value using PASSWORD_DEFAULT
     */
    public static function make(string $value): string
    {
        return password_hash($value, PASSWORD_DEFAULT);
    }

    /**
     * Verify a value against a hashed value
     *
     * @param string $value Plain text value to check
     * @param string $hashedValue Existing hashed value
     * @return bool True if the value matches the hash
     */
    public static function check(string $value, string $hashedValue): bool
    {
        return password_verify($value, $hashedValue);
    }
}
