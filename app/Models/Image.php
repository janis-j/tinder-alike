<?php

namespace App\Models;

class Image
{
    private string $id;
    private int $userId;
    private string $originalName;
    private string $path;

    public function __construct(
        string $id,
        int $userId,
        string $originalName,
        string $path
    )
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->originalName = $originalName;
        $this->path = $path;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function userId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function originalName(): string
    {
        return $this->originalName;
    }

    public function setOriginalName(string $originalName): void
    {
        $this->originalName = $originalName;
    }

    public function path(): string
    {
        return $this->path;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->userId,
            'original_name' => $this->originalName,
            'path' => $this->path
        ];
    }
}