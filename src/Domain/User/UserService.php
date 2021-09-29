<?php declare(strict_types=1);

namespace Domain\User;

use Domain\User\Dto\UserCreateDto;
use Domain\User\Exception\UserNotFoundException;
use Domain\User\Exception\UserUniqueException;
use Domain\User\Validation\CreateScenario;

class UserService
{
    protected UserRepositoryInterface $repository;

    protected UserFactory $factory;

    protected CreateScenario $createScenario;

    public function __construct(
        UserRepositoryInterface $repository,
        UserFactory $factory,
        CreateScenario $createScenario
    ) {
        $this->repository = $repository;
        $this->factory = $factory;
        $this->createScenario = $createScenario;
    }

    public function getUser(string $id): User
    {
        return $this->repository->findById($id);
    }

    public function getUsers(
        array $conditions = [],
        array $order = [],
        int $limit = 0,
        int $offset = 0
    ): UserCollection {
        return $this->repository->findUsers($conditions = [], $order = [], $limit = 0, $offset = 0);
    }

    public function createUser(UserCreateDto $dto): User
    {
        $this->createScenario->validateDto($dto);
        if ($dto->getPassword() !== $dto->getPasswordVerify()) {
            throw new \InvalidArgumentException('Password and confirmation are not equal');
        }
        try {
            $user = $this->repository->findByEmail($dto->getEmail());
            throw new UserUniqueException();
        } catch (UserNotFoundException $e) {}
        $user = $this->factory->create(
            $dto->getEmail(),
            $dto->getFirstName(),
            $dto->getLastName(),
            $this->hashPassword($dto->getPassword())
        );
        $this->repository->insert($user);
        return $user;
    }

    protected function hashPassword(string $password): string
    {
        //@TODO inject password encoder instead of this method
        return $password;
    }
}
