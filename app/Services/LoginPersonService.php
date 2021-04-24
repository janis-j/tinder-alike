<?php

namespace App\Services;

use App\Models\Person;
use App\Repositories\Persons\PersonsRepository;

class LoginPersonService
{
    private PersonsRepository $personsRepository;

    public function __construct(PersonsRepository $personsRepository)
    {
        $this->personsRepository = $personsRepository;
    }

    public function execute(array $logInPerson): ?Person
    {
        $person = $this->personsRepository->getPerson('user_name', $logInPerson['user_name']);
        if (isset($person)) {
            if ($person->name() === $logInPerson['user_name'] &&
                password_verify($logInPerson['password'], $person->password())) {
                $_SESSION['authId'] = $person->id();
                return $person;
            }
        }
        return null;
    }
}