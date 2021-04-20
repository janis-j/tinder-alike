<?php

namespace App\Models;

class Person
{
    private int $id;
    private string $name;
    private string $password;
    private string $gender;

    public function __construct(
        int $id,
        string $name,
        string $password,
        string $gender
    )
    {
        $this->setId($id);
        $this->setName($name);
        $this->setPassword($password);
        $this->setGender($gender);
    }

    private function setId(int $id): void
    {
            $this->id = $id;
    }

    private function setName(string $name): void
    {
        $this->name = ucfirst(strtolower($name));
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    private function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function gender(): string
    {
        return $this->gender;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "user_name" => $this->name,
            "password" => $this->password,
            "gender" => $this->gender
        ];
    }
}