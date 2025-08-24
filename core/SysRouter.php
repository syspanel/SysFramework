<?php

namespace Core;

class SysRouter
{
    private static $routes = [];
    private static $namedRoutes = [];
    private static $errorCallback;
    private static $allowedMethods = ['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS', 'HEAD'];
    private static $middleware = [];
    private static $cacheFile = __DIR__ . '/../cache/routes.php';
    private static $currentGroup = null;

    private static $requestCounts = [];
    private static $requestLimit = 100; // Limite de requisições
    private static $timeFrame = 60; // Tempo em segundos

    private static $flashMessages = [];
    private static $customErrorPages = [];

    public static function get($path, $controller)
    {
        return self::addRoute('GET', $path, $controller);
    }

    public static function post($path, $controller)
    {
        return self::addRoute('POST', $path, $controller);
    }

    public static function put($path, $controller)
    {
        return self::addRoute('PUT', $path, $controller);
    }

    public static function delete($path, $controller)
    {
        return self::addRoute('DELETE', $path, $controller);
    }

    public static function group(array $attributes, callable $callback)
    {
        $previousGroup = self::$currentGroup;
        $prefix = $attributes['prefix'] ?? '';
        $middlewares = $attributes['middleware'] ?? [];

        self::$currentGroup = [
            'prefix' => rtrim($prefix, '/'),
            'middleware' => $middlewares
        ];

        $callback();

        self::$currentGroup = $previousGroup;
    }

    private static function addRoute($method, $path, $controller)
    {
        if (!in_array($method, self::$allowedMethods)) {
            throw new \Exception("Method not allowed: {$method}");
        }

        if (self::$currentGroup) {
            $path = self::$currentGroup['prefix'] . '/' . ltrim($path, '/');
            $path = rtrim($path, '/');
            $middlewares = self::$currentGroup['middleware'];
        } else {
            $middlewares = [];
        }

        foreach (self::$routes as $route) {
            if ($route['path'] === $path && $route['method'] === $method) {
                throw new \Exception("Route already exists: {$method} {$path}");
            }
        }

        $route = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'name' => null,
            'params' => self::extractParams($path),
            'middleware' => $middlewares
        ];

        self::$routes[] = &$route;

        return new class($route) {
            private $route;

            public function __construct(&$route)
            {
                $this->route = &$route;
            }

            public function name($routeName)
            {
                $this->route['name'] = $routeName;
                SysRouter::registerNamedRoute($routeName, $this->route);
            }
        };
    }

    private static function extractParams($path)
    {
        preg_match_all('/\{([a-zA-Z0-9_]+)\}/', $path, $matches);
        return $matches[1] ?? [];
    }

    public static function registerNamedRoute($name, $route)
    {
        self::$namedRoutes[$name] = $route;
    }

 private static function rateLimit($ip)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start(); // Iniciar a sessão se não estiver ativa
    }

    $currentTime = time();
    $lockDuration = 300; // Tempo de bloqueio de 300 segundos (5 minutos)

    // Verifica se há dados de bloqueio na sessão
    if (isset($_SESSION['blocked_ips'][$ip])) {
        // Se o IP estiver bloqueado e o tempo não expirou
        if ($_SESSION['blocked_ips'][$ip]['blocked_until'] > $currentTime) {
            http_response_code(429);
            echo "Você foi temporariamente bloqueado. Tente novamente após 5 minutos.";
            exit;
        } else {
            // Se o tempo de bloqueio expirou, remover o bloqueio
            unset($_SESSION['blocked_ips'][$ip]);
        }
    }

    // Limpar requisições antigas da sessão que estão fora do timeFrame
    if (isset($_SESSION['request_counts'][$ip]) && $_SESSION['request_counts'][$ip]['timestamp'] < $currentTime - self::$timeFrame) {
        unset($_SESSION['request_counts'][$ip]);
    }

    // Contagem de requisições para o IP atual
    if (!isset($_SESSION['request_counts'][$ip])) {
        $_SESSION['request_counts'][$ip] = ['count' => 1, 'timestamp' => $currentTime];
    } else {
        $_SESSION['request_counts'][$ip]['count']++;
    }

    // Verifica se o limite de requisições foi excedido
    if ($_SESSION['request_counts'][$ip]['count'] > self::$requestLimit) {
        $_SESSION['blocked_ips'][$ip] = [
            'blocked_until' => $currentTime + $lockDuration
        ]; // Bloquear por 300 segundos

        self::logBlock($ip); // Log do IP bloqueado

        http_response_code(429);
        echo "Muitas requisições. Você está bloqueado por 5 minutos.";
        exit;
    }

    // Atualiza o timestamp da última requisição
    $_SESSION['request_counts'][$ip]['timestamp'] = $currentTime;
}

private static function logBlock($ip)
{
    $logFile = __DIR__ . '/../logs/block.log';
    $date = date('Y-m-d H:i:s');
    $blockedUntil = $_SESSION['blocked_ips'][$ip]['blocked_until'] ?? 'não disponível';
    
    $logMessage = "[{$date}] IP: {$ip} foi bloqueado por excesso de requisições até: " . date('Y-m-d H:i:s', $blockedUntil) . PHP_EOL;

    if (!is_writable(dirname($logFile))) {
        echo "Log directory is not writable.";
        return;
    }

    if (file_put_contents($logFile, $logMessage, FILE_APPEND) === false) {
        echo "Failed to write to block log file.";
    }
}









 public static function resolve($requestMethod, $requestUri, $dependencies = [])
{
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    self::rateLimit($ip);

    // Verifica se o método foi alterado
    if ($requestMethod === 'POST' && isset($_POST['_method'])) {
        $requestMethod = strtoupper($_POST['_method']);
    }

    $uriParts = explode('?', $requestUri, 2);
    $requestPath = $uriParts[0];
    parse_str($uriParts[1] ?? '', $queryParams);

    foreach (self::$routes as $route) {
        if ($route['method'] === $requestMethod) {
            $params = self::matchUri($route['path'], $requestPath);
            if ($params !== false) {
                try {
                    self::validateParams($params, $route['params']);
                    self::applyMiddleware($route['middleware']);
                    self::logAccess($route['path']);
                    return self::callController($route['controller'], $dependencies, $params);
                } catch (\Exception $e) {
                    http_response_code(400);
                    echo "Invalid parameters!";
                    return;
                }
            }
        }
    }

    if (self::$errorCallback) {
        self::logError("Oops! Página não encontrada.", $requestPath);
        call_user_func(self::$errorCallback);
    } else {
        self::handleCustomError(404);
    }
}


    private static function matchUri($routePath, $requestUri)
    {
        $routePattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_\-]+)', $routePath);
        $routePattern = "#^" . $routePattern . "$#";

        if (preg_match($routePattern, $requestUri, $matches)) {
            array_shift($matches);
            return $matches;
        }

        return false;
    }

    private static function validateParams($params, $routeParams)
    {
        if (count($params) != count($routeParams)) {
            throw new \Exception("Invalid number of parameters.");
        }

        foreach ($params as $index => $param) {
            if (!is_string($param) || empty($param)) {
                throw new \Exception("Invalid parameter: {$routeParams[$index]}");
            }
            $params[$index] = self::sanitize($param);
        }
    }

    private static function sanitize($value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    public static function route($name, $params = [])
    {
        if (!isset(self::$namedRoutes[$name])) {
            throw new \Exception("Route name not found: {$name}");
        }

        $path = self::$namedRoutes[$name]['path'];
        foreach ($params as $key => $value) {
            $path = str_replace('{' . $key . '}', $value, $path);
        }

        return $path;
    }

    public static function callController($controller, $dependencies, $params = [])
    {
        list($controllerClass, $method) = explode('@', $controller);
        $controllerInstance = new $controllerClass(...$dependencies);

        if (method_exists($controllerInstance, $method)) {
            return $controllerInstance->$method(...$params);
        }

        http_response_code(500);
        echo "Method not found!";
    }

    public static function error($callback)
    {
        self::$errorCallback = $callback;
    }

    public static function middleware($middleware)
    {
        self::$middleware[] = $middleware;
    }

    private static function applyMiddleware($controllerInstance)
    {
        foreach (self::$middleware as $middleware) {
            $middlewareInstance = new $middleware();
            if (method_exists($middlewareInstance, 'handle')) {
                $middlewareInstance->handle();
            }
        }
    }

    public static function cacheRoutes()
    {
        $cachedRoutes = serialize(self::$routes);
        file_put_contents(self::$cacheFile, $cachedRoutes);
    }

    public static function loadRoutesFromCache()
    {
        if (file_exists(self::$cacheFile)) {
            self::$routes = unserialize(file_get_contents(self::$cacheFile));
        }
    }

    public static function generateDocumentation()
    {
        $doc = "Method | Path | Controller\n";
        $doc .= "------ | ---- | ----------\n";

        foreach (self::$routes as $route) {
            $doc .= "{$route['method']} | {$route['path']} | {$route['controller']}\n";
        }

        file_put_contents(__DIR__ . '/../docs/routes.md', $doc);
    }

    private static function logError($message, $route)
    {
        $logFile = __DIR__ . '/../logs/router.log';
        $date = date('Y-m-d H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $logMessage = "[{$date}] IP: {$ip} ROUTE: {$route} ERROR: {$message}" . PHP_EOL;

        if (!is_writable(dirname($logFile))) {
            echo "Log directory is not writable.";
            return;
        }

        if (file_put_contents($logFile, $logMessage, FILE_APPEND) === false) {
            echo "Failed to write to log file.";
        }
    }

    private static function logAccess($route)
    {
        $logFile = __DIR__ . '/../logs/access.log';
        $date = date('Y-m-d H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $logMessage = "[{$date}] IP: {$ip} ACCESS ROUTE: {$route}" . PHP_EOL;

        if (!is_writable(dirname($logFile))) {
            echo "Log directory is not writable.";
            return;
        }

        if (file_put_contents($logFile, $logMessage, FILE_APPEND) === false) {
            echo "Failed to write to access log file.";
        }
    }

    public static function jsonResponse($data, $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public static function flash($key, $message)
    {
        self::$flashMessages[$key] = $message;
    }

    public static function getFlash($key)
    {
        return self::$flashMessages[$key] ?? null;
    }

    public static function validateCsrf($token)
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] !== $token) {
            http_response_code(403);
            echo "Invalid CSRF token.";
            exit;
        }
    }

    public static function setCustomErrorPage($code, callable $callback)
    {
        self::$customErrorPages[$code] = $callback;
    }

    private static function handleCustomError($code)
    {
        if (isset(self::$customErrorPages[$code])) {
            call_user_func(self::$customErrorPages[$code]);
        } else {
            http_response_code($code);
            echo "Erro {$code}: Página não encontrada.";
        }
    }

    public static function redirect($routeName, $params = [])
    {
        $path = self::route($routeName, $params);
        header("Location: {$path}", true, 302);
        exit;
    }
    
    public static function debugRoutes()
{
    foreach (self::$routes as $route) {
        echo "{$route['method']} - {$route['path']} \n";
    }
}


}
