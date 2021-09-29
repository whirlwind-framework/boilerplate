<?php declare(strict_types=1);

include __DIR__ . '/../../../../vendor/autoload.php';

use Dotenv\Dotenv;
use League\Container\Container;
use Psr\Http\Message\ServerRequestInterface;
use Whirlwind\App\Application\Adapter\LeagueApplicationFactoryAdapter;
use App\Api\ServiceProvider\ApiServiceProvider;

$worker = new Spiral\RoadRunner\Http\PSR7Worker(
    Spiral\RoadRunner\Worker::create(),
    new Laminas\Diactoros\ServerRequestFactory(),
    new Laminas\Diactoros\StreamFactory,
    new Laminas\Diactoros\UploadedFileFactory
);

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


while ($request = $worker->waitRequest()) {
    try {
        $response = $app->handle($request);
        $worker->respond($response);
    } catch (Throwable $e) {
        $worker->getWorker()->error((string)$e);
    }
}
