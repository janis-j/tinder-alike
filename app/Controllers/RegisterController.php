<?php

namespace App\Controllers;

use App\Bootstrap\RenderView;
use App\Services\StorePersonService;

class RegisterController
{
    private RenderView $renderView;
    private StorePersonService $storePersonService;

    public function __construct(RenderView $renderView, StorePersonService $storePersonService)
    {
        $this->renderView = $renderView;
        $this->storePersonService = $storePersonService;
    }

    public function index(): string
    {
        return $this->renderView->view('RegisterView.twig',[])->content();
    }

    public function execute(): void
    {
        if($this->storePersonService->execute($_POST))
        {
            header('location: /login');
        }else{
            header('location: /register');
        }
    }
}