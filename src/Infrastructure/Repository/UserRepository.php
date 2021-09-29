<?php declare(strict_types=1);

namespace Infrastructure\Repository;

use Domain\User\UserCollection;
use Domain\User\User;
use Domain\User\Exception\UserNotFoundException;
use Domain\User\UserRepositoryInterface;
use Whirlwind\Infrastructure\Repository\Exception\NotFoundException;
use Whirlwind\Infrastructure\Repository\IdentityRepository;

class UserRepository extends IdentityRepository implements UserRepositoryInterface
{
    public function findById(string $id): User
    {
        try {
            /** @var User $user */
            $user = $this->findOne(['_id' => $id]);
            return $user;
        } catch (NotFoundException $exception) {
            throw new UserNotFoundException();
        }
    }

    public function findByEmail(string $email): User
    {
        try {
            /** @var User $user */
            $user = $this->findOne(['email' => $email]);
            return $user;
        } catch (NotFoundException $exception) {
            throw new UserNotFoundException();
        }
    }

    public function findUsers(
        array $conditions = [],
        array $order = [],
        int $limit = 0,
        int $offset = 0
    ): UserCollection {
        return new UserCollection(parent::findAll($conditions, $order, $limit, $offset));
    }
}
