<?php

namespace App\Repositories\Tokens;

use App\Models\Token;

interface TokensRepository
{
    public function save(Token $token): void;

    public function getToken(string $key, string $value): ?Token;
}