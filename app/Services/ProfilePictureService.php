<?php

namespace App\Services;

use App\Repositories\Images\ImagesRepository;

class ProfilePictureService
{
    private ImagesRepository $imagesRepository;

    public function __construct(ImagesRepository $imagesRepository)
    {
        $this->imagesRepository = $imagesRepository;
    }

    public function execute(string $id): string
    {
        $picturesArray = $this->imagesRepository->search($id);
        if(empty($picturesArray)){
            return '/Pictures/profile_default_image.jpg';
        }else {
            return $picturesArray[0]['path'];
        }
    }
}