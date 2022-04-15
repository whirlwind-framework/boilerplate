<?php

namespace App\Console\Commands;

use Domain\User\Dto\UserCreateDto;
use Domain\User\UserService;
use Whirlwind\App\Console\CommandInterface;

class CreateUserCommand implements CommandInterface
{
    private UserService $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

    /**
     * @throws \ReflectionException
     * @throws \Domain\User\Exception\UserUniqueException
     * @throws \Whirlwind\Domain\Validation\Exception\ValidateException
     */
    public function run(array $params = [])
    {
        $dto = $this->createDtoFromAliases($params['_aliases']);
        $this->userService->createUser($dto);
    }

    /**
     * @throws \ReflectionException
     */
    private function createDtoFromAliases(array $aliases = []): UserCreateDto
    {
        return new UserCreateDto([
            'email' => $aliases['email'],
            'firstName' => $aliases['firstName'],
            'lastName' => $aliases['lastName'],
            'password' => $aliases['password'],
            'passwordVerify' => $aliases['password'],
        ]);
    }
}