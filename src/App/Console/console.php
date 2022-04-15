<?php declare(strict_types=1);

include  __DIR__ . '/../../../vendor/autoload.php';

use App\Console\Commands\CreateUserCommand;
use App\Console\Commands\ListUsersCommand;
use App\Console\ServiceProvider\ConsoleServiceProvider;
use Dotenv\Dotenv;
use League\Container\Container;
use Whirlwind\App\Console\Application;
use Whirlwind\App\Console\Request;

$dotenv = Dotenv::createImmutable(dirname(__DIR__.'/../', 2));
$dotenv->load();


$container = new Container();

$container->addServiceProvider(new ConsoleServiceProvider());

$app = new Application($container);

$app->addCommand('users/create', CreateUserCommand::class);
$app->addCommand('users/list', ListUsersCommand::class);

$app->run(new Request());
