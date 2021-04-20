<?php

namespace App\Bootstrap;

class View
{
    private string $twig;

    public function __construct(string $twig)
    {
        $this->twig = $twig;
    }

    public function content(): string
    {
        return $this->twig;
    }
}