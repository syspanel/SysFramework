<?php  
if (!isset($_SESSION)) { session_start(); }

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

use Core\SysEnv;

// Carregar variáveis de ambiente do arquivo .env
SysEnv::load();

define("APP_NAME", SysEnv::get('APP_NAME', 'SysFramework'));
define("APP_ENV", SysEnv::get('APP_ENV', 'local'));
define("APP_KEY", SysEnv::get('APP_KEY', ''));
define("APP_DEBUG", SysEnv::get('APP_DEBUG', 'true'));
define("APP_TIMEZONE", SysEnv::get('APP_TIMEZONE', 'UTC'));
define("APP_URL", SysEnv::get('APP_URL', 'http://localhost'));
define("APP_LOCALE", SysEnv::get('APP_LOCALE', 'utf-8'));
define("BCRYPT_ROUNDS", SysEnv::get('BCRYPT_ROUNDS', '12'));

define("DB_CONNECTION", SysEnv::get('DB_CONNECTION', 'mysql'));
define("DB_CHARSET", SysEnv::get('DB_CHARSET', 'utf-8'));
define("DB_COLLATION", SysEnv::get('DB_COLLATION', 'utf8mb4_general_ci'));
define("DB_PREFIX", SysEnv::get('DB_PREFIX', 'sis'));
define("DB_HOST", SysEnv::get('DB_HOST', '127.0.0.1'));
define("DB_PORT", SysEnv::get('DB_PORT', '3306'));
define("DB_DATABASE", SysEnv::get('DB_DATABASE', 'sysframework'));
define("DB_USERNAME", SysEnv::get('DB_USERNAME', 'root'));
define("DB_PASSWORD", SysEnv::get('DB_PASSWORD', ''));



define("MAIL_TRANSPORT", SysEnv::get('MAIL_TRANSPORT', 'smtp'));
define("MAIL_HOST", SysEnv::get('MAIL_HOST', 'sandbox.smtp.mailtrap.io'));
define("MAIL_PORT", SysEnv::get('MAIL_PORT', '2525'));
define("MAIL_USERNAME", SysEnv::get('MAIL_USERNAME', '2e9a381e6ae31d'));
define("MAIL_PASSWORD", SysEnv::get('MAIL_PASSWORD', 'd5138b45ed4c22'));
define("MAIL_ENCRYPTION", SysEnv::get('MAIL_ENCRYPTION', 'tls'));
define("MAIL_FROM_ADDRESS", SysEnv::get('MAIL_FROM_ADDRESS', 'marcocosta@gmx.us'));
define("MAIL_FROM_NAME", SysEnv::get('MAIL_FROM_NAME', 'SysFramework'));
define("MAILER_DSN", SysEnv::get('MAILER_DSN', 'smtp://2e9a381e6ae31d:d5138b45ed4c22@sandbox.smtp.mailtrap.io:2525'));
define("MAIL_URL", SysEnv::get('MAIL_URL', ''));

?>
