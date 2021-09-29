<?php declare(strict_types=1);

namespace Infrastructure\Hydrator;

use Whirlwind\Infrastructure\Hydrator\Accessor\AccessorInterface;
use Whirlwind\Infrastructure\Hydrator\MongoHydrator;
use Whirlwind\Infrastructure\Hydrator\Strategy\DateTimeImmutableStrategy;

class UserHydrator extends MongoHydrator
{
    public function __construct(AccessorInterface $accessor)
    {
        parent::__construct($accessor);
        $this->addStrategy(
            'createdAt',
            new DateTimeImmutableStrategy()
        );
    }
}
