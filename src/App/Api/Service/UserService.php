<?php declare(strict_types=1);

namespace App\Api\Service;

use Domain\User\User;
use Domain\User\UserCollection;
use Domain\User\UserService as DomainService;
use Psr\Http\Message\ServerRequestInterface;
use App\Api\Http\Request\UserCreateDtoFactory;

class UserService
{
    protected DomainService $domainService;

    protected UserCreateDtoFactory $userCreateDtoFactory;

    public function __construct(
        DomainService $domainService,
        UserCreateDtoFactory $userCreateDtoFactory
    ) {
        $this->domainService = $domainService;
        $this->userCreateDtoFactory = $userCreateDtoFactory;
    }

    public function create(ServerRequestInterface $request): User
    {
        $dto = $this->userCreateDtoFactory->create($request);
        return $this->domainService->createUser($dto);
    }

    public function getUser(string $id): User
    {
        return $this->domainService->getUser($id);
    }

    public function getUsers(ServerRequestInterface $request): UserCollection
    {
        return $this->domainService->getUsers();
    }
}
