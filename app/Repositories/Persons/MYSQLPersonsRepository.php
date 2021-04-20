<?php

namespace App\Repositories\Persons;

use App\Models\Person;
use Medoo\Medoo;

class MYSQLPersonsRepository implements PersonsRepository
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

    public function save(Person $person): void
    {
        $this->database->insert('tinder_persons', $person->toArray());
    }

    public function getPersons(string $searchField, string $textInput): array
    {
        return $this->database->select("tinder_persons", [
            "id",
            "user_name",
            "password",
            "gender"
        ], [
            "{$searchField}[=]" => $textInput
        ]);
    }

    public function deletePerson(string $id): void
    {
        $this->database->delete("tinder_persons", [
            "AND" => [
                "id" => $id,
            ]
        ]);
    }

    public function executeDescription(array $idDescription): void
    {
        $this->database->update("Registry", [
            "description" => $idDescription[0]
        ], [
            "id[=]" => $idDescription[1]
        ]);
    }

    public function getPerson(string $textInput): ?Person
    {
        $person = $this->database->select("tinder_persons", [
            "id",
            "user_name",
            "password",
            "gender"
        ], [
            "user_name[=]" => $textInput
        ]);
        if ($person) {
            return new Person(
                $person[0]["id"],
                $person[0]["user_name"],
                $person[0]["password"],
                $person[0]["gender"]
            );
        }
        return null;
    }
}