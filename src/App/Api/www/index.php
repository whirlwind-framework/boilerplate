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

$container->addServiceProvider(ApiServiceProvider::class);

$app->map('GET', '/', function (ServerRequestInterface $request) {
    return new \Laminas\Diactoros\Response\JsonResponse([
        'title'   => 'My New Simple API',
        'version' => 1,
    ]);
});
$app->map('GET', '/users/{id}', \App\Api\Action\User\UserViewAction::class);
$app->map('GET', '/users', \App\Api\Action\User\UserIndexAction::class);
$app->map('POST', '/users', \App\Api\Action\User\UserCreateAction::class);

$app->run();
