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

namespace Core\Library;

class Session
{
    /**
     * Default session cookie parameters
     */
    protected static array $defaultParams = [
        'lifetime' => 0,           // Session cookie lifetime in seconds (0 = until browser closes)
        'path' => '/',              // Cookie path
        'domain' => '',             // Cookie domain
        'secure' => false,          // Only transmit cookie over HTTPS if true
        'httponly' => true,         // Prevent access via JavaScript
        'samesite' => 'Lax',        // Lax by default ('Strict', 'Lax', or 'None')
    ];

    /**
     * Start a session with optional cookie parameters
     *
     * @param array $options Override default cookie parameters
     */
    public static function start(array $options = []): void
    {
        $opts = array_merge(self::$defaultParams, $options);

        // Do not start sessions in CLI
        if (php_sapi_name() === 'cli') return;

        // If session is already active, do nothing
        if (session_status() === PHP_SESSION_ACTIVE) return;

        // Set cookie parameters depending on PHP version
        if (PHP_VERSION_ID >= 70300) {
            session_set_cookie_params([
                'lifetime' => $opts['lifetime'],
                'path' => $opts['path'],
                'domain' => $opts['domain'],
                'secure' => $opts['secure'],
                'httponly' => $opts['httponly'],
                'samesite' => $opts['samesite'],
            ]);
        } else {
            ini_set('session.cookie_lifetime', (string)$opts['lifetime']);
            ini_set('session.cookie_path', $opts['path']);
            if (!empty($opts['domain'])) ini_set('session.cookie_domain', $opts['domain']);
            ini_set('session.cookie_secure', $opts['secure'] ? '1' : '0');
            ini_set('session.cookie_httponly', $opts['httponly'] ? '1' : '0');
        }

        // Start the session
        session_start();
    }

    /**
     * Regenerate the session ID to prevent fixation attacks
     *
     * @param bool $deleteOld Whether to delete the old session
     */
    public static function regenerate(bool $deleteOld = true): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) return;
        session_regenerate_id($deleteOld);
    }

    /**
     * Set a session variable
     *
     * @param string $index
     * @param mixed $value
     */
    public static function set(string $index, $value): void
    {
        $_SESSION[$index] = $value;
    }

    /**
     * Get a session variable
     *
     * @param string $index
     * @param mixed $default Value to return if the key does not exist
     * @return mixed
     */
    public static function get(string $index, $default = null)
    {
        return $_SESSION[$index] ?? $default;
    }

    /**
     * Check if a session variable exists
     *
     * @param string $index
     * @return bool
     */
    public static function has(string $index): bool
    {
        return isset($_SESSION[$index]);
    }

    /**
     * Remove a session variable
     *
     * @param string $index
     */
    public static function remove(string $index): void
    {
        if (isset($_SESSION[$index])) unset($_SESSION[$index]);
    }

    /**
     * Destroy the session completely
     * Clears session data and deletes session cookie
     */
    public static function destroy(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) return;

        // Clear session data
        $_SESSION = [];

        // Delete the session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Destroy the session
        session_destroy();
    }
}
