<?php

namespace App\Services;

class TokenRequest
{
    private string $token;
    private string $userId;
    private int $time;


    public function __construct(
        string $token,
        string $userId,
        int $time

    )
    {
        $this->setToken($token);
        $this->setUserId($userId);
        $this->setTime($time);
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    public function setTime(int $time): void
    {
        $this->time = $time;
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
}