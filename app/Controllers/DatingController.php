<?php

namespace App\Controllers;

use App\Bootstrap\RenderView;
use App\Services\DatingService;

class DatingController
{
    private RenderView $renderView;
    private DatingService $datingService;

    public function __construct(RenderView $renderView, DatingService $datingService)
    {
        $this->renderView = $renderView;
        $this->datingService = $datingService;
    }

    public function index(): string
    {
        return $this->renderView->view('DatingView.twig', [
            'img' => $this->datingService->next($_SESSION['authId'])
        ])->content();
    }
}
