<?php declare(strict_types=1);

namespace App\Api\ServiceProvider;

use Domain\User\User;
use Domain\User\UserRepositoryInterface;
use Infrastructure\Hydrator\UserHydrator;
use Infrastructure\Repository\TableGateway\UserTableGateway;
use Infrastructure\Repository\UserRepository;
use League\Container\Container;
use League\Container\ServiceProvider\AbstractServiceProvider;
use Psr\Container\ContainerInterface;
use Whirlwind\Domain\Factory\UidFactoryInterface;
use Whirlwind\Infrastructure\Persistence\Mongo\UidFactory\MongoUidFactory;
use Whirlwind\Infrastructure\Hydrator\Accessor\AccessorInterface;
use Whirlwind\Infrastructure\Hydrator\Accessor\PropertyAccessor;
use Whirlwind\Infrastructure\Persistence\Mongo\Command\MongoCommandFactory;
use Whirlwind\Infrastructure\Persistence\Mongo\MongoConnection;
use Whirlwind\Infrastructure\Persistence\Mongo\Structure\MongoDatabaseFactory;
use Whirlwind\Infrastructure\Persistence\Mongo\Query\MongoQueryBuilderFactory;

class ApiServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        ContainerInterface::class,
        MongoConnection::class,
        AccessorInterface::class,
        UserRepositoryInterface::class,
        UidFactoryInterface::class
    ];

    public function register(): void
    {
        /** @var Container $container */
        $container = $this->getContainer();
        $container->add(
            ContainerInterface::class,
            $container
        )->setShared();
        $container->add(
            MongoConnection::class,
            function () use ($container) {
                return new MongoConnection(
                    $container->get(MongoCommandFactory::class),
                    $container->get(MongoQueryBuilderFactory::class),
                    $container->get(MongoDatabaseFactory::class),
                    $_ENV['MONGODB_DSN']
                );
            }
        )->setShared();
        $container->add(
            AccessorInterface::class,
            PropertyAccessor::class
        );
        $container->add(
            UserRepositoryInterface::class,
            function () use ($container) {
                return new UserRepository(
                    $container->get(UserTableGateway::class),
                    $container->get(UserHydrator::class),
                    User::class
                );
            }
        );
        $container->add(UidFactoryInterface::class, MongoUidFactory::class);
    }

    public function provides(string $id): bool
    {
        return in_array($id, $this->provides, true);
    }
}
