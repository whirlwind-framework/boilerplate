<?php declare(strict_types=1);

include  __DIR__ . '/../../../vendor/autoload.php';

use Dotenv\Dotenv;
use League\Container\Container;

$dotenv = Dotenv::createImmutable(dirname(__DIR__.'/../', 2));
$dotenv->load();


$container = new Container();
$container->addServiceProvider(new \App\Console\ServiceProvider\ConsoleServiceProvider());
$container->addServiceProvider(new \App\Console\ServiceProvider\UserServiceProvider());

$container->add(\App\Console\Commands\CreateUserCommand::class)->addArgument($container->get(\Domain\User\UserService::class));

$app = new \Whirlwind\App\Console\Application($container);

$app->addCommand('create/user', \App\Console\Commands\CreateUserCommand::class);

$app->run(new \Whirlwind\App\Console\Request());
