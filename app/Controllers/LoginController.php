<?php

namespace App\Controllers;

use App\Bootstrap\RenderView;
use App\Services\LoginPersonService;
use App\Services\TokenService;

class LoginController
{
    private RenderView $renderView;
    private TokenService $tokenService;
    private LoginPersonService $loginPersonService;

    public function __construct(RenderView $renderView,
                                TokenService $tokenService,
                                LoginPersonService $loginPersonService
    )
    {
        $this->renderView = $renderView;
        $this->tokenService = $tokenService;
        $this->loginPersonService = $loginPersonService;
    }

    public function index(): string
    {
        return $this->renderView->view('LoginView.twig', [])->content();
    }

    public function execute()
    {
        $person = $this->loginPersonService->execute($_POST);
        if(isset($person))
        {
            $this->tokenService->execute($person->id());
            header('location: /');
        }else
        {
            header('location: /login');
        }
    }
}