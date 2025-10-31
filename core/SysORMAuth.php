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

use Core\SysORMHash;
use App\Models\Auth;

/**
 * SysORMAuth - simple authentication helper using SysORM
 * - Handles login, logout, and retrieval of the current user
 * - Uses session management securely
 */
class SysORMAuth
{
    /**
     * Ensure the session has started
     */
    protected static function ensureSessionStarted(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    /**
     * Attempt to authenticate a user with credentials
     *
     * @param array $credentials ['email' => string, 'password' => string]
     * @return bool True if authentication is successful, false otherwise
     */
    public static function attempt(array $credentials): bool
    {
        self::ensureSessionStarted();

        if (empty($credentials['email']) || empty($credentials['password'])) {
            return false;
        }

        // Find user by email using Auth model
        $users = Auth::where('email', $credentials['email']);
        $user = $users[0] ?? null;

        if ($user && SysORMHash::check($credentials['password'], $user['password'])) {
            // Regenerate session ID to prevent fixation
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            return true;
        }

        return false;
    }

    /**
     * Log out the currently authenticated user
     */
    public static function logout(): void
    {
        self::ensureSessionStarted();

        // Remove user session
        unset($_SESSION['user_id']);
        $_SESSION = [];

        // Delete session cookie if cookies are used
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

        // Destroy session
        session_destroy();
    }

    /**
     * Get the currently authenticated user
     *
     * @return array|null Returns user data or null if no user is logged in
     */
    public static function user(): ?array
    {
        self::ensureSessionStarted();

        if (isset($_SESSION['user_id'])) {
            $users = Auth::where('id', $_SESSION['user_id']);
            return $users[0] ?? null;
        }

        return null;
    }
}
