<?php
if (!isset($_SESSION)) {
    session_start();
}

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

// SysSanitize
use Core\SysSanitize;

function sanitizeMiddleware()
{
    $_POST = SysSanitize::sanitize($_POST);
    $_GET = SysSanitize::sanitize($_GET);
    $_REQUEST = SysSanitize::sanitize($_REQUEST);
}
#sanitizeMiddleware();


// Função para carregar arquivos de configuração no formato .php ou .ini e retornar um array associativo com as configurações

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

// Uso:
// $config = loadConfig('/path/to/config.php');






// Função para Limpar e Escapar Input

function sanitize($data)
{
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

// Uso:
// $userInput = "<script>alert('Hacked!');</script>";
// $cleanInput = sanitize($userInput);  // Output: alert('Hacked!');




// Função para Redirecionamento Simples

function redirect($url, $statusCode = 302)
{
    header("Location: $url", true, $statusCode);
    exit();
}

// Uso:
// redirect('/home');





// Função para Log de Erros

function logError($message, $file = 'error.log')
{
    $timestamp = date('Y-m-d H:i:s');
    $message = "[{$timestamp}] ERROR: {$message}\n";
    file_put_contents($file, $message, FILE_APPEND);
}

// Uso:
// logError('Database connection failed');




// Função para Geração de URLs

function baseUrl($path = '')
{
    $baseUrl = "http://" . $_SERVER['HTTP_HOST'] . "/";
    return $baseUrl . ltrim($path, '/');
}

// Uso:
// echo baseUrl('assets/css/style.css');  // Output: http://localhost/assets/css/style.css





// Função para Manipulação de Sessões

function startSecureSession()
{
    if (session_status() == PHP_SESSION_NONE) {
        ini_set('session.use_only_cookies', 1);
        $secure = isset($_SERVER['HTTPS']);
        session_set_cookie_params(0, '/', '', $secure, true);
        session_start();
    }
}

// Uso:
// startSecureSession();
// $_SESSION['user_id'] = 1;





// Função para Formatar Datas

function formatDate($date, $format = 'd/m/Y H:i')
{
    $timestamp = strtotime($date);
    return date($format, $timestamp);
}

// Uso:
// echo formatDate('2025-08-30 14:30:00');  // Output: 30/08/2025 14:30




// Função para Renderizar View com Template Engine

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

// Uso:
// loadView('header', ['title' => 'Home Page']);




// Função para Renderizar View com Template Engine Twig

function renderView($templateName, $data = [])
{
    // Obtém o ambiente Twig
    $twig = getTwigEnvironment();

    // Renderiza o template com os dados fornecidos
    echo $twig->render($templateName . '.html.twig', $data);
}



// Função para Criptografia Simples

function encrypt($data, $key)
{
    return openssl_encrypt($data, 'aes-256-cbc', $key, 0, str_repeat('0', 16));
}

function decrypt($data, $key)
{
    return openssl_decrypt($data, 'aes-256-cbc', $key, 0, str_repeat('0', 16));
}

// Uso:
// $encrypted = encrypt('secret', 'my_key');
// echo decrypt($encrypted, 'my_key');  // Output: secret





// Função para AutoCarregamento de Classes

function autoload($className)
{
    $classPath = __DIR__ . '/../core/' . $className . '.php';
    if (file_exists($classPath)) {
        require_once $classPath;
    }
}

spl_autoload_register('autoload');



// Função para Formatação de Moeda

function formatCurrency($amount, $currencySymbol = 'R$', $decimals = 2, $decimalSeparator = ',', $thousandsSeparator = '.')
{
    if (!is_numeric($amount)) {
        throw new InvalidArgumentException("The amount must be a number.");
    }

    $formattedAmount = number_format($amount, $decimals, $decimalSeparator, $thousandsSeparator);
    return $currencySymbol . ' ' . $formattedAmount;
}

// Uso:
// Valor em reais com 2 casas decimais
// echo formatCurrency(2500); // Output: R$ 2.500,00

// Valor em dólares com 2 casas decimais e separadores americanos
// echo formatCurrency(2500, '$', 2, '.', ','); // Output: $ 2,500.00

// Valor em euros sem casas decimais
// echo formatCurrency(2500, '€', 0, ',', '.'); // Output: € 2.500

// Valor em reais sem separador de milhares
// echo formatCurrency(2500.75, 'R$', 2, ',', ''); // Output: R$ 2500,75




// Função para Formatar Números em Duas Casas Decimais

// https://www.google.com/url?sa=t&source=web&rct=j&opi=89978449&url=https://www.issnetonline.com.br/santamaria/online/login/Login.aspx%3FgetFile%3D49&ved=2ahUKEwjxpZXN_ZyIAxWKkZUCHanIBAkQFnoECCsQAQ&usg=AOvVaw0-j-gTCkER5sUIzkJkMMYf

// https://www.jusbrasil.com.br/jurisprudencia/busca?q=arredondamento+do+valor

function formatToTwoDecimals($number)
{
    if (!is_numeric($number)) {
        throw new InvalidArgumentException("The input must be a number.");
    }

    return number_format($number, 2, '.', '');
}

// Uso:
// Formatar um número com muitas casas decimais
// echo formatToTwoDecimals(45.6789);  // Output: 45.68

// Formatar um número inteiro
// echo formatToTwoDecimals(45);  // Output: 45.00

// Formatar um número com uma casa decimal
// echo formatToTwoDecimals(45.6);  // Output: 45.60

// Formatar um número já com duas casas decimais
// echo formatToTwoDecimals(45.60);  // Output: 45.60



// Função para Calcular o Número de Dias Entre Duas Datas

function daysBetweenDates($date1, $date2)
{
    // Converte as datas para objetos DateTime
    $date1 = new DateTime($date1);
    $date2 = new DateTime($date2);

    // Calcula a diferença entre as duas datas
    $interval = $date1->diff($date2);

    // Retorna o número de dias como um inteiro
    return abs($interval->days);
}

// Uso:
// echo daysBetweenDates('2025-08-01', '2025-08-30');  // Output: 29
// echo daysBetweenDates('2025-08-30', '2025-08-01');  // Output: 29 (ordem das datas não importa)









// Função para Calcular o Tempo em Minutos Entre Dois Eventos

function minutesBetweenEvents($event1, $event2)
{
    // Converte as datas e horários para objetos DateTime
    $dateTime1 = new DateTime($event1);
    $dateTime2 = new DateTime($event2);

    // Calcula a diferença entre os dois objetos DateTime
    $interval = $dateTime1->diff($dateTime2);

    // Converte a diferença para minutos
    $minutes = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;

    // Retorna a diferença em minutos
    return $minutes;
}

// Uso
$event1 = '2025-08-30 14:00:00';
$event2 = '2025-08-30 16:30:00';

# echo minutesBetweenEvents($event1, $event2);  // Output: 150
