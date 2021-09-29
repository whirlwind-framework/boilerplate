<?php declare(strict_types=1);

namespace Domain\User;

use Whirlwind\Domain\Factory\UidFactoryInterface;

class UserFactory
{
    protected $uidFactory;

    public function __construct(UidFactoryInterface $uidFactory)
    {
        $this->uidFactory = $uidFactory;
    }

    public function create(string $email, string $firstName, string $lastName, string $passwordHash): User
    {
        return new User(
            $this->uidFactory->create('user'),
            $email,
            $firstName,
            $lastName,
            $passwordHash
        );
    }
}
