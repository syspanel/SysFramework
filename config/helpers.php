<?php
if (!isset($_SESSION)) { session_start(); }

// Desbloquear IP por excesso de requisições
function unblockIp($ip) {
    // Verifica se o IP está bloqueado
    if (isset($_SESSION['blocked_ips'][$ip])) {
        unset($_SESSION['blocked_ips'][$ip]); // Remove o IP da lista de bloqueios
        echo "IP {$ip} foi desbloqueado com sucesso.";
    } else {
        echo "IP {$ip} não está bloqueado.";
    }
}

// Chame a função com o IP que deseja desbloquear
# unblockIp('170.231.184.32'); // Substitua pelo IP desejado




if (!function_exists('asset')) {
    /**
     * Gera a URL para um arquivo de asset (CSS, JS, imagens, etc.).
     *
     * @param string $path O caminho relativo para o asset.
     * @return string A URL completa para o asset.
     */
    function asset($path)
    {
        $baseUrl = rtrim($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'], '/');
        return $baseUrl . '/' . ltrim($path, '/');
    }
}

if (!function_exists('url')) {
    /**
     * Gera a URL completa para uma rota nomeada.
     *
     * @param string $name O nome da rota.
     * @param array $params Parâmetros da rota, se houver.
     * @return string A URL completa para a rota.
     */
    function url($name, $params = [])
    {
        // Aqui você pode implementar a lógica para gerar URLs baseadas em nomes de rotas
        // Isso é um exemplo e pode precisar ser adaptado de acordo com seu roteador.
        if (!isset(Core\SysRouter::$namedRoutes[$name])) {
            throw new Exception("Route name not found: {$name}");
        }

        $route = Core\SysRouter::$namedRoutes[$name];
        $path = $route['path'];

        foreach ($params as $key => $value) {
            $path = str_replace('{' . $key . '}', $value, $path);
        }

        return asset($path);
    }
}




// SysSanitize
use Core\SysSanitize;
function sanitizeMiddleware() {
    $_POST = SysSanitize::sanitize($_POST);
    $_GET = SysSanitize::sanitize($_GET);
    $_REQUEST = SysSanitize::sanitize($_REQUEST);
}
#sanitizeMiddleware();


// Função para carregar arquivos de configuração no formato .php ou .ini e retornar um array associativo com as configurações

function loadConfig($filePath) {
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

function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

// Uso:
// $userInput = "<script>alert('Hacked!');</script>";
// $cleanInput = sanitize($userInput);  // Output: alert('Hacked!');





// Função para Log de Erros

function logError($message, $file = 'error.log') {
    $timestamp = date('Y-m-d H:i:s');
    $message = "[{$timestamp}] ERROR: {$message}\n";
    file_put_contents($file, $message, FILE_APPEND);
}

// Uso:
// logError('Database connection failed');




// Função para Geração de URLs

function baseUrl($path = '') {
    $baseUrl = "http://".$_SERVER['HTTP_HOST']."/";
    return $baseUrl . ltrim($path, '/');
}

// Uso:
// echo baseUrl('assets/css/style.css');  // Output: http://localhost/assets/css/style.css





// Função para Manipulação de Sessões

function startSecureSession() {
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

function formatDate($date, $format = 'd/m/Y H:i') {
    $timestamp = strtotime($date);
    return date($format, $timestamp);
}

// Uso:
// echo formatDate('2025-08-30 14:30:00');  // Output: 30/08/2025 14:30




// Função para Renderizar View com Template Engine

function loadView($viewName, $data = []) {
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






// Função para Criptografia Simples

function encrypt($data, $key) {
    return openssl_encrypt($data, 'aes-256-cbc', $key, 0, str_repeat('0', 16));
}

function decrypt($data, $key) {
    return openssl_decrypt($data, 'aes-256-cbc', $key, 0, str_repeat('0', 16));
}

// Uso:
// $encrypted = encrypt('secret', 'my_key');
// echo decrypt($encrypted, 'my_key');  // Output: secret





// Função para AutoCarregamento de Classes

function autoload($className) {
    $classPath = __DIR__ . '/../core/' . $className . '.php';
    if (file_exists($classPath)) {
        require_once $classPath;
    }
}

spl_autoload_register('autoload');



// Função para Formatação de Moeda

function formatCurrency($amount, $currencySymbol = 'R$', $decimals = 2, $decimalSeparator = ',', $thousandsSeparator = '.') {
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

function formatToTwoDecimals($number) {
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

function daysBetweenDates($date1, $date2) {
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

function minutesBetweenEvents($event1, $event2) {
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


// Gera um token CSRF para proteção contra ataques CSRF.
function generateCsrfToken() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
# generateCsrfToken()


# Verifica se um token CSRF é válido.
function checkCsrfToken($token) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
# checkCsrfToken()


// Obtém a URL completa da página atual
function getFullUrl() {
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}
# getFullUrl()


// Retorna o objeto DateTime atual.
function now() {
    return new DateTime();
}
# now()





// Redireciona o usuário para uma URL específica.
function redirect($url, $statusCode = 302) {
    header("Location: $url", true, $statusCode);
    exit();
}
# redirect()



// Obtém o valor antigo de uma entrada (útil para formulários).
function old($key = null, $default = null) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    return $_SESSION['old_input'][$key] ?? $default;
}
# old()


// Lança uma exceção HTTP.
function abort($statusCode, $message = '') {
    http_response_code($statusCode);
    echo $message;
    exit();
}
# abort()



// Gera um hash bcrypt para uma senha.
if (!function_exists('bcrypt')) {
    function bcrypt($value)
    {
        return password_hash($value, PASSWORD_BCRYPT);
    }
}

# $hashedPassword = bcrypt('minhasenha');





// Limita o comprimento de uma string.
function str_limit($value, $limit = 100, $end = '...') {
    return mb_strlen($value) > $limit ? mb_substr($value, 0, $limit) . $end : $value;
}
# str_limit()




// Obtém o primeiro item de um array.
function array_first($array, $callback = null) {
    if ($callback === null) {
        return reset($array);
    }
    foreach ($array as $item) {
        if ($callback($item)) {
            return $item;
        }
    }
    return null;
}
# array_first()


// Obtém o último item de um array.
function array_last($array, $callback = null) {
    if ($callback === null) {
        return end($array);
    }
    foreach (array_reverse($array) as $item) {
        if ($callback($item)) {
            return $item;
        }
    }
    return null;
}
# array_last()


// Obtém ou define valores de configuração.
function config($key, $default = null) {
    static $config = [];
    if (empty($config)) {
        $config = require __DIR__ . '/../config/settings.php'; // Ajuste o caminho conforme necessário
    }
    return $config[$key] ?? $default;
}
# config()


// Obtém o caminho para o diretório de armazenamento.
function storage_path($path = '') {
    return __DIR__ . '/../storage/' . $path; // Ajuste o caminho conforme necessário
}
# storage_path()


// Obtém o caminho para o diretório público.
function public_path($path = '') {
    return __DIR__ . '/../public/' . $path; // Ajuste o caminho conforme necessário
}
# public_path()



// Obtém o caminho para o diretório de views (para incluir arquivos)
function views_path($path = '') {
    return __DIR__ . '/../resources/views/' . $path; // Ajuste o caminho conforme necessário
}
# views_path()
#  @include(views_path('sysframework/home.blade.php'))





// dd() (Dump and Die)
if (!function_exists('dd')) {
    /**
     * Dump the variables and die.
     *
     * @param mixed ...$vars
     * @return void
     */
    function dd(...$vars)
    {
        if (empty($vars)) {
            echo "Break with dd()";
        } else {
            foreach ($vars as $var) {
                var_dump($var);
            }
        }
        die();
    }
}
# dd($var);




// Redireciona o usuário para a página anterior
if (!function_exists('back')) {
    function back()
    {
        $previous = $_SERVER['HTTP_REFERER'] ?? '/';
        redirect($previous);
    }
}
# back()




// Renderiza uma view e insere dados nela
if (!function_exists('view')) {
    function view($view, $data = [])
    {
        extract($data); // Converte os itens do array em variáveis
        include "/caminho/para/views/{$view}.php";
    }
}
# view('welcome', ['name' => 'João']);




// Gera uma "slug" de uma string, útil para criar URLs amigáveis.
if (!function_exists('str_slug')) {
    function str_slug($string, $separator = '-')
    {
        // Remove caracteres especiais
        $slug = preg_replace('/[^a-zA-Z0-9]+/', $separator, strtolower($string));

        // Remove separadores extras
        return trim($slug, $separator);
    }
}
# echo str_slug('Título de Exemplo para Slug');  // Resultado: titulo-de-exemplo-para-slug



// Escapa uma string para ser usada em HTML, prevenindo injeções XSS
if (!function_exists('e')) {
    function e($value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
    }
}
# echo e('<script>alert("XSS!")</script>');  // Resultado: &lt;script&gt;alert(&quot;XSS!&quot;)&lt;/script&gt;




// Gera uma string aleatória de um determinado tamanho, útil para senhas, tokens, etc.
if (!function_exists('str_random')) {
    function str_random($length = 16)
    {
        return bin2hex(random_bytes($length / 2));
    }
}
# echo str_random(16);  // Exemplo de saída: e9c8f1b1dfe2b5c8



// Permite acessar propriedades de objetos que podem ser nulos, evitando erros.
if (!function_exists('optional')) {
    function optional($value = null)
    {
        return new class($value) {
            private $value;

            public function __construct($value)
            {
                $this->value = $value;
            }

            public function __get($name)
            {
                return $this->value ? $this->value->$name : null;
            }
        };
    }
}
# $user = null;
# echo optional($user)->name;  // Não lança erro, apenas retorna null



// Verifica se um valor é "vazio", ou seja, null, '', [], false ou 0.
if (!function_exists('blank')) {
    function blank($value)
    {
        return is_null($value) || $value === '' || $value === [] || $value === false || $value === 0;
    }
}
# if (blank($user->name)) {
#    echo 'Nome não preenchido';
# }




// Verifica se um valor está preenchido (é o oposto de blank())
if (!function_exists('filled')) {
    function filled($value)
    {
        return !blank($value);
    }
}
# if (filled($user->name)) {
#    echo 'Nome preenchido';
# }



if (!function_exists('route')) {
    function route($name, $params = []) {
        return \Core\SysRouter::route($name, $params);
    }
}



// Retorna data atual
if (!function_exists('now')) {
    function now() {
        return date('Y-m-d H:i:s');
    }
}



// Gera um numero randomico inteiro entre dois valores
if (!function_exists('generateRandomNumber')) {
    /**
     * Generates a random integer between two values
     *
     * @param int $min Minimum value
     * @param int $max Maximum value
     * @return int Randomly generated integer
     */
    function generateRandomNumber($min, $max)
    {
        // Check if the provided values are valid
        if (!is_int($min) || !is_int($max) || $min > $max) {
            throw new InvalidArgumentException("The parameters must be integers, and the minimum value should be less than or equal to the maximum value.");
        }

        // Generate and return the random integer
        return (int) rand($min, $max); // or mt_rand($min, $max) if preferred
    }
}


# $randomNumber = generateRandomNumber(10, 100);
# echo $randomNumber;




?>
