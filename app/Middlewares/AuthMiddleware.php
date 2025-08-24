<?php

namespace App\Middlewares;

class AuthMiddleware
{
    public function handle($request, $next)
    {
        if (!isset($_SESSION['user_id'])) {
            // Redirecionar ou lançar um erro
            return ['error' => 'Você não está autenticado.'];
        }
        return $next($request);
    }
}

