<?php declare(strict_types=1);

namespace Domain\User;

use Whirlwind\Domain\Collection\IdentityCollection;

class UserCollection extends IdentityCollection
{
    public function __construct(array $items = [])
    {
        parent::__construct(User::class, $items);
    }
}
