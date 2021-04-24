<?php

namespace App\Repositories\Tokens;

use App\Models\Token;
use Medoo\Medoo;

class MYSQLTokensRepository implements TokensRepository
{
    private Medoo $database;

    public function __construct()
    {
        $this->database = new Medoo([
            'database_type' => 'mysql',
            'database_name' => 'codelex',
            'server' => 'localhost',
            'username' => 'janis',
            'password' => 'Maximus21@'
        ]);
    }

    public function save(Token $token): void
    {
        $this->database->insert("Tokens", $token->toArray());
    }

    public function getToken(string $key, string $value): ?Token
    {
        $token = $this->database->select("Tokens", [
            'id',
            'token',
            'userId',
            'time'
        ], [
            $key => "$value"
        ]);
        if(!empty($token)) {
            return new Token(
                $token[0]['id'],
                $token[0]['token'],
                $token[0]['userId'],
                $token[0]['time']
            );
        }
        return null;
    }
}