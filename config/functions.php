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

// Middleware to sanitize global inputs
function sanitizeMiddleware()
{
    $_POST = SysSanitize::sanitize($_POST);
    $_GET = SysSanitize::sanitize($_GET);
    $_REQUEST = SysSanitize::sanitize($_REQUEST);
}
// #sanitizeMiddleware();


// Function to load configuration files (.php or .ini) and return an associative array
function loadConfig($filePath)
{
    if (!file_exists($filePath)) {
        throw new Exception("Config file not found: $filePath");
    }

    $ext = pathinfo($filePath, PATHINFO_EXTENSION);

    switch ($ext) {
        case 'php':
            return include $filePath;
        case 'ini':
            return parse_ini_file($filePath, true);
        default:
            throw new Exception("Unsupported config file format: $ext");
    }
}
// Usage: $config = loadConfig('/path/to/config.php');


// Function to sanitize and escape input
function sanitize($data)
{
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}
// Usage:
// $userInput = "<script>alert('Hacked!');</script>";
// $cleanInput = sanitize($userInput);  // Output: alert('Hacked!');


// Simple redirect function
function redirect($url, $statusCode = 302)
{
    header("Location: $url", true, $statusCode);
    exit();
}
// Usage: redirect('/home');


// Error logging function
function logError($message, $file = 'error.log')
{
    $timestamp = date('Y-m-d H:i:s');
    $message = "[{$timestamp}] ERROR: {$message}\n";
    file_put_contents($file, $message, FILE_APPEND);
}
// Usage: logError('Database connection failed');


// Function to generate full base URL
function baseUrl($path = '')
{
    $baseUrl = "http://" . $_SERVER['HTTP_HOST'] . "/";
    return $baseUrl . ltrim($path, '/');
}
// Usage: echo baseUrl('assets/css/style.css');  // Output: http://localhost/assets/css/style.css


// Function to start a secure session
function startSecureSession()
{
    if (session_status() == PHP_SESSION_NONE) {
        ini_set('session.use_only_cookies', 1);
        $secure = isset($_SERVER['HTTPS']);
        session_set_cookie_params(0, '/', '', $secure, true);
        session_start();
    }
}
// Usage:
// startSecureSession();
// $_SESSION['user_id'] = 1;


// Function to format dates
function formatDate($date, $format = 'd/m/Y H:i')
{
    $timestamp = strtotime($date);
    return date($format, $timestamp);
}
// Usage: echo formatDate('2025-08-30 14:30:00');  // Output: 30/08/2025 14:30


// Function to load a PHP view
function loadView($viewName, $data = [])
{
    $viewFile = __DIR__ . '/../views/' . $viewName . '.php';
    if (file_exists($viewFile)) {
        extract($data);
        include $viewFile;
    } else {
        throw new Exception("View not found: $viewName");
    }
}
// Usage: loadView('header', ['title' => 'Home Page']);


// Function to render a Twig template
function renderView($templateName, $data = [])
{
    $twig = getTwigEnvironment();
    echo $twig->render($templateName . '.html.twig', $data);
}


// Simple encryption and decryption
function encrypt($data, $key)
{
    return openssl_encrypt($data, 'aes-256-cbc', $key, 0, str_repeat('0', 16));
}
function decrypt($data, $key)
{
    return openssl_decrypt($data, 'aes-256-cbc', $key, 0, str_repeat('0', 16));
}
// Usage:
// $encrypted = encrypt('secret', 'my_key');
// echo decrypt($encrypted, 'my_key');  // Output: secret


// Autoload classes from /core
function autoload($className)
{
    $classPath = __DIR__ . '/../core/' . $className . '.php';
    if (file_exists($classPath)) {
        require_once $classPath;
    }
}
spl_autoload_register('autoload');


// Function to format currency
function formatCurrency($amount, $currencySymbol = 'R$', $decimals = 2, $decimalSeparator = ',', $thousandsSeparator = '.')
{
    if (!is_numeric($amount)) {
        throw new InvalidArgumentException("The amount must be a number.");
    }
    $formattedAmount = number_format($amount, $decimals, $decimalSeparator, $thousandsSeparator);
    return $currencySymbol . ' ' . $formattedAmount;
}
// Examples:
// echo formatCurrency(2500); // Output: R$ 2.500,00
// echo formatCurrency(2500, '$', 2, '.', ','); // Output: $ 2,500.00
// echo formatCurrency(2500, '€', 0, ',', '.'); // Output: € 2.500
// echo formatCurrency(2500.75, 'R$', 2, ',', ''); // Output: R$ 2500,75


// Function to format numbers with two decimals
function formatToTwoDecimals($number)
{
    if (!is_numeric($number)) {
        throw new InvalidArgumentException("The input must be a number.");
    }
    return number_format($number, 2, '.', '');
}
// Examples:
// echo formatToTwoDecimals(45.6789); // Output: 45.68
// echo formatToTwoDecimals(45);      // Output: 45.00
// echo formatToTwoDecimals(45.6);    // Output: 45.60
// echo formatToTwoDecimals(45.60);   // Output: 45.60


// Function to calculate days between two dates
function daysBetweenDates($date1, $date2)
{
    $date1 = new DateTime($date1);
    $date2 = new DateTime($date2);
    $interval = $date1->diff($date2);
    return abs($interval->days);
}
// Examples:
// echo daysBetweenDates('2025-08-01', '2025-08-30'); // Output: 29
// echo daysBetweenDates('2025-08-30', '2025-08-01'); // Output: 29


// Function to calculate minutes between two events
function minutesBetweenEvents($event1, $event2)
{
    $dateTime1 = new DateTime($event1);
    $dateTime2 = new DateTime($event2);
    $interval = $dateTime1->diff($dateTime2);
    $minutes = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;
    return $minutes;
}
// Example:
// $event1 = '2025-08-30 14:00:00';
// $event2 = '2025-08-30 16:30:00';
// echo minutesBetweenEvents($event1, $event2); // Output: 150
