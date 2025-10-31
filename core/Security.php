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
 * Class Security
 * -------------------------------------------------------------------------
 * Provides essential security utilities for sanitization, CSRF protection,
 * and input validation. This class helps prevent common web vulnerabilities
 * such as XSS (Cross-Site Scripting) and CSRF (Cross-Site Request Forgery).
 *
 * @package SysFramework\Core
 * @since 1.0.0
 */
class Security
{
    /**
     * Sanitize a string by removing HTML and PHP tags and converting
     * special characters to HTML entities.
     *
     * Prevents XSS attacks by neutralizing scripts or embedded tags.
     *
     * @param string $value The input string to sanitize
     * @return string The sanitized string
     */
    public static function sanitize($value)
    {
        return htmlspecialchars(strip_tags($value), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Escape a string to prevent SQL injection attacks.
     *
     * This is a placeholder — in production, use prepared statements
     * instead of manual escaping (PDO or MySQLi parameter binding).
     *
     * @param string $value The input string to escape
     * @return string The escaped string (if applicable)
     * @example
     *  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
     *  $stmt->execute([$email]);
     */
    public static function escapeSql($value)
    {
        // This method depends on the database library used.
        // Example with PDO: always use prepared statements.
        return $value;
    }

    /**
     * Generate a CSRF token (Cross-Site Request Forgery protection)
     * and store it in the current session.
     *
     * @return string The generated CSRF token
     */
    public static function generateCsrfToken()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Validate a submitted CSRF token against the stored session token.
     *
     * @param string $token The CSRF token to verify
     * @return bool True if valid, false otherwise
     */
    public static function validateCsrfToken($token)
    {
        return hash_equals($_SESSION['csrf_token'] ?? '', $token);
    }

    /**
     * Escape a string to prevent HTML and JavaScript injection.
     * Converts special characters into HTML entities.
     *
     * @param string $value The input string to escape
     * @return string The HTML-safe string
     */
    public static function escapeHtml($value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Validate if a given string is a safe and valid URL.
     *
     * @param string $url The URL to validate
     * @return bool True if valid, false if invalid
     */
    public static function validateUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }
}
