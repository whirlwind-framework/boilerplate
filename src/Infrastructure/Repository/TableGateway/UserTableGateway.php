<?php declare(strict_types=1);

namespace Infrastructure\Repository\TableGateway;

use Whirlwind\Infrastructure\Persistence\Mongo\ConditionBuilder\ConditionBuilder;
use Whirlwind\Infrastructure\Persistence\Mongo\Query\MongoQueryFactory;
use Whirlwind\Infrastructure\Repository\TableGateway\MongoTableGateway;
use Whirlwind\Infrastructure\Persistence\Mongo\MongoConnection;

class UserTableGateway extends MongoTableGateway
{
    public const COLLECTION_NAME = 'users';

    public function __construct(
        MongoConnection $connection,
        MongoQueryFactory $queryFactory,
        ConditionBuilder $conditionBuilder
    ) {
        parent::__construct($connection, $queryFactory, $conditionBuilder, self::COLLECTION_NAME);
    }
}
