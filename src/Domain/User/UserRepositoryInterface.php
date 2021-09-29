<?php declare(strict_types=1);

namespace Domain\User;

use Whirlwind\Domain\Repository\IdentityRepositoryInterface;
use Domain\User\Exception\UserNotFoundException;

interface UserRepositoryInterface extends IdentityRepositoryInterface
{
    /**
     * @param string $email
     * @throws UserNotFoundException
     * @return User
     */
    public function findByEmail(string $email): User;

    /**
     * @param string $id
     * @throws UserNotFoundException
     * @return User
     */
    public function findById(string $id): User;

    public function findUsers(
        array $conditions = [],
        array $order = [],
        int $limit = 0,
        int $offset = 0
    ): UserCollection;
}
