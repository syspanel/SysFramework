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

use Core\SysSanitize;
use Core\SysRouter;

/**
 * -------------------------------
 * AUTOLOADER PSR-4
 * -------------------------------
 */
spl_autoload_register(function ($class) {
    $prefixes = [
        'Core\\' => __DIR__ . '/../core/',
        'App\\'  => __DIR__ . '/../app/',
    ];

    foreach ($prefixes as $prefix => $baseDir) {
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) continue;
        $relativeClass = substr($class, $len);
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
        if (file_exists($file)) require_once $file;
    }
});

/**
 * -------------------------------
 * SANITIZATION
 * -------------------------------
 */
function sanitizeMiddleware() {
    $_POST = SysSanitize::sanitize($_POST);
    $_GET = SysSanitize::sanitize($_GET);
    $_REQUEST = SysSanitize::sanitize($_REQUEST);
}
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * -------------------------------
 * URL & ROUTES
 * -------------------------------
 */
function baseUrl($path = '') {
    return "http://" . $_SERVER['HTTP_HOST'] . '/' . ltrim($path, '/');
}
function asset($path) {
    return rtrim($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'], '/') . '/' . ltrim($path, '/');
}
function route($name, $params = []) {
    return SysRouter::route($name, $params);
}

/**
 * -------------------------------
 * REDIRECTION & ABORT
 * -------------------------------
 */
function redirect($url, $statusCode = 302) {
    header("Location: $url", true, $statusCode);
    exit();
}
function back() {
    redirect($_SERVER['HTTP_REFERER'] ?? '/');
}
function abort($statusCode, $message = '') {
    http_response_code($statusCode);
    echo $message;
    exit();
}

/**
 * -------------------------------
 * SESSION HELPERS
 * -------------------------------
 */
function startSecureSession() {
    if (session_status() == PHP_SESSION_NONE) {
        ini_set('session.use_only_cookies', 1);
        $secure = isset($_SERVER['HTTPS']);
        session_set_cookie_params(0, '/', '', $secure, true);
        session_start();
    }
}
function old($key = null, $default = null) {
    return $_SESSION['old_input'][$key] ?? $default;
}

/**
 * -------------------------------
 * CSRF PROTECTION
 * -------------------------------
 */
function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
function checkCsrfToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * -------------------------------
 * VIEW RENDERING
 * -------------------------------
 */
function loadView($view, $data = []) {
    $viewFile = __DIR__ . '/../resources/views/' . $view . '.php';
    if (file_exists($viewFile)) {
        extract($data);
        include $viewFile;
    } else {
        throw new Exception("View not found: $view");
    }
}
function renderView($templateName, $data = []) {
    $twig = getTwigEnvironment(); // Must return Twig environment
    echo $twig->render($templateName . '.html.twig', $data);
}

/**
 * -------------------------------
 * ENCRYPTION
 * -------------------------------
 */
function encrypt($data, $key) {
    return openssl_encrypt($data, 'aes-256-cbc', $key, 0, str_repeat('0', 16));
}
function decrypt($data, $key) {
    return openssl_decrypt($data, 'aes-256-cbc', $key, 0, str_repeat('0', 16));
}

/**
 * -------------------------------
 * DEBUG & DUMP
 * -------------------------------
 */
function dd(...$vars) {
    foreach ($vars as $var) var_dump($var);
    die();
}

/**
 * -------------------------------
 * FILE & PATH HELPERS
 * -------------------------------
 */
function storage_path($path = '') { return __DIR__ . '/../storage/' . $path; }
function public_path($path = '') { return __DIR__ . '/../public/' . $path; }
function views_path($path = '') { return __DIR__ . '/../resources/views/' . $path; }
function config($key, $default = null) {
    static $config = [];
    if (empty($config)) $config = require __DIR__ . '/../config/settings.php';
    return $config[$key] ?? $default;
}

/**
 * -------------------------------
 * STRING UTILITIES
 * -------------------------------
 */
function str_limit($value, $limit = 100, $end = '...') {
    return mb_strlen($value) > $limit ? mb_substr($value, 0, $limit) . $end : $value;
}
function str_slug($string, $separator = '-') {
    return trim(preg_replace('/[^a-zA-Z0-9]+/', $separator, strtolower($string)), $separator);
}
function str_random($length = 16) {
    return bin2hex(random_bytes($length / 2));
}
function e($value) { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false); }
function optional($value = null) {
    return new class($value) { private $value; public function __construct($v){$this->value=$v;} public function __get($name){return $this->value?$this->value->$name:null;} };
}
function blank($value) { return is_null($value)||$value===''||$value===[]||$value===false||$value===0; }
function filled($value) { return !blank($value); }

/**
 * -------------------------------
 * ARRAY UTILITIES
 * -------------------------------
 */
function array_first($array, $callback = null) {
    if ($callback===null) return reset($array);
    foreach($array as $item) if($callback($item)) return $item;
    return null;
}
function array_last($array, $callback = null) {
    if ($callback===null) return end($array);
    foreach(array_reverse($array) as $item) if($callback($item)) return $item;
    return null;
}

/**
 * -------------------------------
 * RANDOM UTILITIES
 * -------------------------------
 */
function generateRandomNumber($min, $max) {
    if(!is_int($min)||!is_int($max)||$min>$max) throw new InvalidArgumentException("Parameters must be integers and min <= max.");
    return rand($min,$max);
}

/**
 * -------------------------------
 * CURRENCY & NUMBERS
 * -------------------------------
 */
function formatCurrency($amount, $symbol='R$', $decimals=2, $decimalSep=',', $thousandsSep='.') {
    return $symbol . ' ' . number_format($amount, $decimals, $decimalSep, $thousandsSep);
}
function formatToTwoDecimals($number) {
    return number_format($number,2,'.','');
}

/**
 * -------------------------------
 * DATE & TIME
 * -------------------------------
 */
function now() { return date('Y-m-d H:i:s'); }
function formatDate($date, $format='d/m/Y H:i') { return date($format, strtotime($date)); }
function daysBetweenDates($date1, $date2) { return abs((new DateTime($date1))->diff(new DateTime($date2))->days); }
function minutesBetweenEvents($event1, $event2) {
    $interval = (new DateTime($event1))->diff(new DateTime($event2));
    return ($interval->days*24*60)+($interval->h*60)+$interval->i;
}

/**
 * -------------------------------
 * SECURITY
 * -------------------------------
 */
function bcrypt($value) { return password_hash($value,PASSWORD_BCRYPT); }

/**
 * -------------------------------
 * RATE LIMIT / IP BLOCK
 * -------------------------------
 */
function unblockIp($ip) {
    if(isset($_SESSION['blocked_ips'][$ip])) {
        unset($_SESSION['blocked_ips'][$ip]);
        echo "IP {$ip} has been unblocked.";
    } else {
        echo "IP {$ip} is not blocked.";
    }
}

