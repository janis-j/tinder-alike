<?php

namespace App\Services;

use App\Models\Token;
use App\Repositories\Tokens\TokensRepository;

class TokenService

{
    private TokensRepository $tokensRepository;

    public function __construct(TokensRepository $tokensRepository)
    {
        $this->tokensRepository = $tokensRepository;
    }

    public function execute(string $userId): void
    {
        $newToken = openssl_random_pseudo_bytes(16);
        $newToken = bin2hex($newToken);

        $this->tokensRepository->save(new Token(
            0,
            $newToken,
            $userId,
            time()+60
        ));
    }

    public function validation(string $key, string $value): bool
    {
        $token = $this->tokensRepository->getToken($key, $value);

        return $token !== null && $token->time()>time() ;
    }
}