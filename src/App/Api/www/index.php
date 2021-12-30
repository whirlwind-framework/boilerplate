<?php declare(strict_types=1);

include '../../../../vendor/autoload.php';

use Dotenv\Dotenv;
use League\Container\Container;
use Psr\Http\Message\ServerRequestInterface;
use Whirlwind\App\Application\Adapter\LeagueApplicationFactoryAdapter;
use App\Api\ServiceProvider\ApiServiceProvider;

$dotenv = new Dotenv(dirname(dirname(__DIR__)));
$dotenv->load();

$container = new Container();

$app = LeagueApplicationFactoryAdapter::create($container);

$container->addServiceProvider(new ApiServiceProvider());

/** @var Whirlwind\App\Router\Adapter\LeagueRouterAdapter $router */
$router = $container->get(\Whirlwind\App\Router\RouterInterface::class);
$router->map('GET', '/', function (ServerRequestInterface $request) {
    return new \Laminas\Diactoros\Response\JsonResponse([
        'title'   => 'My New Simple API',
        'version' => 1,
    ]);
});

$router->map('GET', '/users/{id}', \App\Api\Action\User\UserViewAction::class);
$router->map('GET', '/users', \App\Api\Action\User\UserIndexAction::class);
$router->map('POST', '/users', \App\Api\Action\User\UserCreateAction::class);

$app->run();
