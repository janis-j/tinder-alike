<?php

namespace App\Controllers;

class LogoutController
{
    public function index()
    {
        header('Location: /login');
        session_destroy();
    }
}