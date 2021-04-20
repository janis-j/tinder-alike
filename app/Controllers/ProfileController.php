<?php

namespace App\Controllers;

use App\Bootstrap\RenderView;

class ProfileController
{
    private RenderView $renderView;

    public function __construct(RenderView $renderView)
    {
        $this->renderView = $renderView;
    }

    public function index(): string
    {
        return $this->renderView->view('ProfileView.twig',[])->content();
    }
}