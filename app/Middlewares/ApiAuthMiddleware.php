<?php

namespace App\Middlewares;

class ApiAuthMiddleware
{
    public function handle($request, $next)
    {
        $token = $request->getHeader('Authorization');

        if ($this->validateToken($token)) {
            return $next($request);
        }

        return json_encode(['error' => 'Unauthorized'], 401);
    }

    private function validateToken($token)
    {
        // Validação de token JWT ou OAuth
        return $token === 'valid_token';
    }
}
