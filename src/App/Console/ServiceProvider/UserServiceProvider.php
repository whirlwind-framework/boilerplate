<?php
declare(strict_types=1);

namespace App\Console\ServiceProvider;

use Domain\User\Dto\UserCreateDto;
use Domain\User\User;
use Domain\User\UserFactory;
use Domain\User\UserRepositoryInterface;
use Domain\User\UserService;
use Domain\User\Validation\CreateScenario;
use Infrastructure\Hydrator\UserHydrator;
use Infrastructure\Repository\TableGateway\UserTableGateway;
use Infrastructure\Repository\UserRepository;
use League\Container\Container;
use League\Container\ServiceProvider\AbstractServiceProvider;
use Psr\Container\ContainerInterface;
use Whirlwind\Domain\Factory\UidFactoryInterface;
use Whirlwind\Domain\Validation\Factory\ValidatorCollectionFactory;
use Whirlwind\Domain\Validation\Factory\ValidatorFactory;
use Whirlwind\Infrastructure\Persistence\Mongo\ConditionBuilder\ConditionBuilder;
use Whirlwind\Infrastructure\Persistence\Mongo\Query\MongoQueryFactory;
use Whirlwind\Infrastructure\Persistence\Mongo\UidFactory\MongoUidFactory;
use Whirlwind\Infrastructure\Hydrator\Accessor\AccessorInterface;
use Whirlwind\Infrastructure\Hydrator\Accessor\PropertyAccessor;
use Whirlwind\Infrastructure\Persistence\Mongo\Command\MongoCommandFactory;
use Whirlwind\Infrastructure\Persistence\Mongo\MongoConnection;
use Whirlwind\Infrastructure\Persistence\Mongo\Structure\MongoDatabaseFactory;
use Whirlwind\Infrastructure\Persistence\Mongo\Query\MongoQueryBuilderFactory;

class UserServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        UserService::class,
    ];

    public function register(): void
    {
        /** @var Container $container */
        $container = $this->getContainer();

        $container->add(
            UserService::class,
            function () use ($container) {
                return new UserService(
                    $container->get(UserRepositoryInterface::class),
                    $container->get(UserFactory::class),
                    $container->get(CreateScenario::class)
                );
            }
        )->setShared();
        $container->add(UserFactory::class)->addArgument($container->get(UidFactoryInterface::class));

        $container->add(CreateScenario::class)->addArguments(
            [
                $container->get(ValidatorFactory::class),
                $container->get(ValidatorCollectionFactory::class),
            ]
        );

        $container->add(ConditionBuilder::class);
        $container->add(UserHydrator::class)->addArgument($container->get(AccessorInterface::class));

        $container->add(UserTableGateway::class)->addArguments(
            [
                $container->get(MongoConnection::class),
                $container->get(MongoQueryFactory::class),
                $container->get(ConditionBuilder::class),
            ]
        );
    }

    public function provides(string $id): bool
    {
        return in_array($id, $this->provides, true);
    }
}
