<?php

namespace App\Services;

use App\Models\Person;
use App\Repositories\Persons\PersonsRepository;

class StorePersonService
{
    private PersonsRepository $personsRepository;

    public function __construct(PersonsRepository $personsRepository)
    {
        $this->personsRepository = $personsRepository;
    }

    public function execute(array $user): bool
    {
        $password = password_hash($user['password'], PASSWORD_DEFAULT);
        if (!$this->personsRepository->getPerson('user_name',$user['user_name'])) {
            $person = new Person(
                0,
                $user['user_name'],
                $password,
                $user['gender']
            );
            $this->personsRepository->save($person);
            return true;
        }
        return false;
    }

}