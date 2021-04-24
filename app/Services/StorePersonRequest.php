<?php

namespace App\Services;

class StorePersonRequest
{
    private int $id;
    private string $name;
    private int $password;
    private string $gender;

    public function __construct(
        int $id,
        string $name,
        string $password,
        int $gender
    )
    {

        $this->id = $id;
        $this->setName($name);
        $this->setPassword($password);
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

    public function password(): string
    {
        return $this->password;
    }

    public function gender(): string
    {
        return $this->gender;
    }

    private function setName(string $name)
    {
        $toLower = mb_strtolower($name);
        $this->name = mb_strtoupper(substr($toLower,0,1)) . substr($toLower,1);
    }

    private function setPassword(string $password)
    {
        $this->password = $password;
    }
}