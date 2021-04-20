<?php

use App\Bootstrap\RenderView;
use App\Controllers\FilesController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\ProfileController;
use App\Controllers\RegisterController;
use App\Controllers\UploadController;
use App\Middlewares\AuthMiddleware;
use App\Repositories\Images\ImagesRepository;
use App\Repositories\Images\MYSQLImagesRepository;
use App\Repositories\Persons\MYSQLPersonsRepository;
use App\Repositories\Persons\PersonsRepository;
use App\Repositories\Tokens\MYSQLTokensRepository;
use App\Repositories\Tokens\TokensRepository;
use App\Services\LoginPersonService;
use App\Services\StorePersonService;
use App\Services\TokenService;
use App\Services\UploadFileService;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once '../vendor/autoload.php';

session_start();

$container = new League\Container\Container;

$container->add(FilesController::class);

$container->add(LogoutController::class);

$container->add(RenderView::class, RenderView::class)
    ->addArguments([
        FilesystemLoader::class,
        Environment::class
    ]);

$container->add(LoginController::class, LoginController::class)
    ->addArguments([
        RenderView::class,
        TokenService::class,
        LoginPersonService::class
        ]);

$container->add(LoginPersonService::class, LoginPersonService::class)
    ->addArguments([
        PersonsRepository::class
        ]);

$container->add(UploadController::class, UploadController::class)
    ->addArguments([
        RenderView::class,
        UploadFileService::class
        ]);

$container->add(RegisterController::class, RegisterController::class)
    ->addArguments([
        RenderView::class,
        StorePersonService::class
        ]);

$container->add(StorePersonService::class, StorePersonService::class)
    ->addArgument(PersonsRepository::class);

$container->add(UploadFileService::class, UploadFileService::class)
    ->addArgument(ImagesRepository::class);

$container->add(TokenService::class, TokenService::class)
    ->addArgument(TokensRepository::class);

$container->add(ProfileController::class, ProfileController::class)
    ->addArgument(RenderView::class);

$container->add(PersonsRepository::class, MYSQLPersonsRepository::class);

$container->add(TokensRepository::class, MYSQLTokensRepository::class);

$container->add(ImagesRepository::class, MYSQLImagesRepository::class);

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute(['GET'], '/', [ProfileController::class,'index']);
    $r->addRoute(['GET'], '/upload', [UploadController::class,'index']);
    $r->addRoute(['GET'], '/login', [LoginController::class,'index']);
    $r->addRoute(['GET'], '/register', [RegisterController::class,'index']);
    $r->addRoute(['GET'], '/logout', [LogoutController::class,'index']);
    $r->addRoute(['POST'], '/upload', [UploadController::class,'execute']);
    $r->addRoute(['POST'], '/register', [RegisterController::class,'execute']);
    $r->addRoute(['POST'], '/login', [LoginController::class,'execute']);
});

$middlewares = [
    ProfileController::class . '@index' =>[
        AuthMiddleware::class
    ],
    UploadController::class . '@index' =>[
        AuthMiddleware::class
    ]
];

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);
var_dump($_FILES);
var_dump($_POST);
var_dump($_SESSION);
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        [$controller, $method] = $handler;

        $middlewareKey = $controller . '@' . $method;
        $controllerMiddlewares = $middlewares[$middlewareKey] ?? [];

        foreach ($controllerMiddlewares as $controllerMiddleware)
        {
            (new $controllerMiddleware)->handle();
        }

        echo ($container->get($controller))->$method($vars);
        break;
}
