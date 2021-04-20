<?php

namespace App\Models;

class Token
{
    private int $id;
    private string $token;
    private string $userId;
    private int $time;

    public function __construct(
        int $id,
        string $token,
        string $userId,
        int $time
    )
    {
        $this->setId($id);
        $this->setToken($token);
        $this->setUserId($userId);
        $this->setTime($time);
    }

    public function id(): int
    {
        return $this->id;
    }

    public function token(): string
    {
        return $this->token;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function time(): int
    {
        return $this->time;
    }

    public function toArray(): array
    {
        return [
            'token' => $this->token,
            'userId' => $this->userId,
            'time' => $this->time
        ];
    }

    private function setToken(string $token): void
    {
        $this->token = $token;
    }

    private function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    private function setTime(int $time): void
    {
        $this->time = $time;
    }

    private function setId(int $id): void
    {
        $this->id = $id;
    }
}