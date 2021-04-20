<?php

namespace App\Middlewares;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(): void
    {
        if (!isset($_SESSION['authId']))
        {
            header('location: /login');
        }
    }
}