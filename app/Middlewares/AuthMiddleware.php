<?php

namespace App\Middlewares;

class AuthMiddleware
{
    public function handle($request, $next)
    {
        if (!isset($_SESSION['user_id'])) {
            
            return ['error' => 'Você não está autenticado.'];
        }
        return $next($request);
    }
}

