<?php

namespace App\Services;

use App\Repositories\Images\ImagesRepository;
use App\Repositories\Persons\PersonsRepository;

class DatingService
{
    private PersonsRepository $personsRepository;
    private ImagesRepository $imagesRepository;

    public function __construct(
        PersonsRepository $personsRepository,
        ImagesRepository $imagesRepository
    )
    {
        $this->personsRepository = $personsRepository;
        $this->imagesRepository = $imagesRepository;
    }

    public function next(int $id): string
    {
        $gender = $this->personsRepository->getPerson('id', $id)->gender();
        $personsId = $this->personsRepository->getPersons('gender[!]', $gender);
        $length = count($personsId);
        return $this->imagesRepository->search($personsId[rand(0, $length-1)]['id'])[0]['path'];
    }

    public function like()
    {

    }
}