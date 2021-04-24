<?php

namespace App\Repositories\Images;

use App\Models\Image;

interface ImagesRepository
{
    public function upload(Image $image): void;

    public function search(string $id): array;
}