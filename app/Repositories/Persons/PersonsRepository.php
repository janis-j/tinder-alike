<?php

namespace App\Repositories\Persons;

use App\Models\Person;

interface PersonsRepository
{
    public function save(Person $person): void;

    public function getPersons(string $searchField, string $textInput): array;

    public function deletePerson(string $id): void;

    public function executeDescription(array $idDescription): void;

    public function getPerson(string $textInput): ?Person;
}