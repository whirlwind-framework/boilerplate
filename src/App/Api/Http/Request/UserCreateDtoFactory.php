<?php declare(strict_types=1);

namespace App\Api\Http\Request;

use Domain\User\Dto\UserCreateDto;
use Psr\Http\Message\ServerRequestInterface;
use Whirlwind\Infrastructure\Http\Request\RequestDtoFactory;

class UserCreateDtoFactory extends RequestDtoFactory
{
    public function __construct()
    {
        parent::__construct(UserCreateDto::class);
    }

    public function extract(ServerRequestInterface $request): array
    {
        $data = $request->getParsedBody();
        return [
            'email' => $data['email'] ?? '',
            'firstName' => $data['firstName'] ?? '',
            'lastName' => $data['lastName'] ?? '',
            'password' => $data['password'] ?? '',
            'passwordVerify' => $data['password2'] ?? '',
        ];
    }
}
