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

use Core\SysEnv;

// Load environment variables from .env file
SysEnv::load();

/**
 * -------------------------------
 * Application Settings
 * -------------------------------
 */
define("APP_NAME", SysEnv::get('APP_NAME', 'SysFramework'));
define("APP_ENV", SysEnv::get('APP_ENV', 'local'));

// APP_KEY should have 32 bytes for security
$defaultKey = bin2hex(random_bytes(32));
define("APP_KEY", SysEnv::get('APP_KEY', $defaultKey));

// APP_DEBUG as real boolean
define("APP_DEBUG", filter_var(SysEnv::get('APP_DEBUG', true), FILTER_VALIDATE_BOOLEAN));

define("APP_TIMEZONE", SysEnv::get('APP_TIMEZONE', 'UTC'));
date_default_timezone_set(APP_TIMEZONE);

define("APP_URL", rtrim(SysEnv::get('APP_URL', 'http://localhost'), '/'));
define("APP_LOCALE", SysEnv::get('APP_LOCALE', 'en_US')); // Locale for dates, currency etc.

/**
 * -------------------------------
 * Database Settings
 * -------------------------------
 */
define("DB_CONNECTION", SysEnv::get('DB_CONNECTION', 'mysql'));
define("DB_CHARSET", SysEnv::get('DB_CHARSET', 'utf8mb4'));
define("DB_COLLATION", SysEnv::get('DB_COLLATION', 'utf8mb4_general_ci'));
define("DB_PREFIX", SysEnv::get('DB_PREFIX', 'sis'));
define("DB_HOST", SysEnv::get('DB_HOST', '127.0.0.1'));
define("DB_PORT", (int) SysEnv::get('DB_PORT', 3306));
define("DB_DATABASE", SysEnv::get('DB_DATABASE', 'sysframework'));
define("DB_USERNAME", SysEnv::get('DB_USERNAME', 'root'));
define("DB_PASSWORD", SysEnv::get('DB_PASSWORD', ''));

/**
 * -------------------------------
 * Mail Settings
 * -------------------------------
 */
define("MAIL_TRANSPORT", SysEnv::get('MAIL_TRANSPORT', 'smtp'));
define("MAIL_HOST", SysEnv::get('MAIL_HOST', 'sandbox.smtp.mailtrap.io'));
define("MAIL_PORT", (int) SysEnv::get('MAIL_PORT', 2525));
define("MAIL_USERNAME", SysEnv::get('MAIL_USERNAME', ''));
define("MAIL_PASSWORD", SysEnv::get('MAIL_PASSWORD', ''));
define("MAIL_ENCRYPTION", SysEnv::get('MAIL_ENCRYPTION', 'tls'));
define("MAIL_FROM_ADDRESS", SysEnv::get('MAIL_FROM_ADDRESS', 'marcocosta@gmx.us'));
define("MAIL_FROM_NAME", SysEnv::get('MAIL_FROM_NAME', 'SysFramework'));

// DSN for Symfony/Laravel-compatible Mailer
define("MAILER_DSN", SysEnv::get('MAILER_DSN', sprintf(
    '%s://%s:%s@%s:%d',
    MAIL_TRANSPORT,
    MAIL_USERNAME,
    MAIL_PASSWORD,
    MAIL_HOST,
    MAIL_PORT
)));

// Base URL for email links, if needed
define("MAIL_URL", SysEnv::get('MAIL_URL', ''));

/**
 * -------------------------------
 * Security Settings
 * -------------------------------
 */
define("BCRYPT_ROUNDS", (int) SysEnv::get('BCRYPT_ROUNDS', 12));

/**
 * -------------------------------
 * Additional Settings
 * -------------------------------
 */
// You can add other constant configurations here
