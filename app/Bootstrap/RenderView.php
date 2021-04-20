<?php

namespace App\Bootstrap;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class RenderView
{
    private Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader('../app/Views');
        $this->twig = new Environment($loader);
    }

    function view(string $path, array $data): View
    {
        return new View($this->twig->render($path, $data));
    }

}