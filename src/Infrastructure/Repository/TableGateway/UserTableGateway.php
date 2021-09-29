<?php declare(strict_types=1);

namespace Infrastructure\Repository\TableGateway;

use Whirlwind\Infrastructure\Persistence\Mongo\Query\MongoQueryFactory;
use Whirlwind\Infrastructure\Repository\TableGateway\MongoTableGateway;
use Whirlwind\Infrastructure\Persistence\Mongo\MongoConnection;

class UserTableGateway extends MongoTableGateway
{
    public const COLLECTION_NAME = 'users';

    public function __construct(MongoConnection $connection, MongoQueryFactory $queryFactory)
    {
        parent::__construct($connection, $queryFactory, self::COLLECTION_NAME);
    }
}
