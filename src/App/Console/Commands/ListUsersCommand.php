<?php

namespace App\Console\Commands;

use App\Console\Resource\UserResource;
use Domain\User\UserService;
use Whirlwind\App\Console\CommandInterface;

class ListUsersCommand implements CommandInterface
{
    private UserService $userService;
    private UserResource $userResource;

    public function __construct(
        UserService $userService,
        UserResource $userResource
    ) {
        $this->userService = $userService;
        $this->userResource = $userResource;
    }

    public function run(array $params = [])
    {
        $users = $this->userService->getUsers();
        $users->rewind();
        while ($users->valid()) {
            $this->userResource->decorate($users->current());

            echo json_encode($this->userResource, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT) . PHP_EOL;

            $users->next();
        }
    }
}