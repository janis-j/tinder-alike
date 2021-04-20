<?php

namespace App\Controllers;

use App\Bootstrap\RenderView;
use App\Services\UploadFileService;

class UploadController
{
    private RenderView $renderView;
    private UploadFileService $uploadFileService;

    public function __construct(RenderView $renderView, UploadFileService $uploadFileService)
    {
        $this->renderView = $renderView;
        $this->uploadFileService = $uploadFileService;
    }

    public function index(): string
    {
        return $this->renderView->view('UploadView.twig',[])->content();
    }

    public function execute(): void
    {
        $this->uploadFileService->execute($_FILES, $_SESSION['authId']);
        header ('Location: /');
    }

}