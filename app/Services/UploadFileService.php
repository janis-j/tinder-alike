<?php

namespace App\Services;

use App\Models\Image;
use App\Repositories\Images\ImagesRepository;

class UploadFileService
{
    private ImagesRepository $imagesRepository;

    public function __construct(ImagesRepository $imagesRepository)
    {
        $this->imagesRepository = $imagesRepository;
    }

    public function execute(array $images, $userId): void
    {
        $image = $images['file'];
        $separateNameFromExtension = explode('.', $image['name']);
        $fileName = reset($separateNameFromExtension);
        $fileSize = $image['size'];
        $fileError = $image['error'];
        $fileType = $image['type'];
        $imageExtension = strtolower(end($separateNameFromExtension));
        $imageNameForRepository = uniqid('', true);
        $path = '/Pictures/' . $userId . "/" . $imageNameForRepository . "." . $imageExtension;
        if(!file_exists('../files/Pictures/' . $userId)){
            mkdir('../files/Pictures/' . $userId);
        }
        move_uploaded_file($image['tmp_name'], '../files/' . $path);

        $this->imagesRepository->upload(new Image(
            $imageNameForRepository,
            $userId,
            $image['name'],
            $path
        ));
    }
}