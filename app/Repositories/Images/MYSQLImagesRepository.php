<?php

namespace App\Repositories\Images;

use App\Models\Image;
use Medoo\Medoo;

class MYSQLImagesRepository implements ImagesRepository
{
    private Medoo $database;

    public function __construct()
    {
        $this->database = new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'codelex',
            'server' => 'localhost',
            'username' => '',
            'password' => ''
        ]);
    }

    public function upload(Image $image): void
    {
        $this->database->insert('images_upload', $image->toArray());
    }
}