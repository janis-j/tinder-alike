<?php

namespace App\Controllers;

use App\Bootstrap\RenderView;
use App\Services\ProfilePictureService;
use App\Services\SearchPersonService;

class ProfileController
{
    private RenderView $renderView;
    private ProfilePictureService $profilePictureService;
    private SearchPersonService $searchPersonService;

    public function __construct(
        RenderView $renderView,
        ProfilePictureService $profilePictureService,
        SearchPersonService $searchPersonService
    )
    {
        $this->renderView = $renderView;
        $this->profilePictureService = $profilePictureService;
        $this->searchPersonService = $searchPersonService;
    }

    public function index(): string
    {
        return $this->renderView->view('ProfileView.twig', [
            'profile_pic' => $this->profilePictureService->execute($_SESSION['authId']),
            'name' => $this->searchPersonService->execute($_SESSION['authId'])->name()
        ])->content();
    }
}