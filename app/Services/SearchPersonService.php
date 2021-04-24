<?php

namespace App\Services;

use App\Models\Person;
use App\Repositories\Persons\PersonsRepository;

class SearchPersonService
{
    private PersonsRepository $personsRepository;

    public function __construct(PersonsRepository $personsRepository)
    {
        $this->personsRepository = $personsRepository;
    }

    public function execute(int $id): Person
    {
        return $this->personsRepository->getPerson('id', $id);
    }
}