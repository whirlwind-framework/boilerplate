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
            'email' => htmlspecialchars($data['email']) ?? '',
            'firstName' => htmlspecialchars($data['firstName']) ?? '',
            'lastName' => htmlspecialchars($data['lastName']) ?? '',
            'password' => htmlspecialchars($data['password']) ?? '',
            'passwordVerify' => htmlspecialchars($data['password2']) ?? '',
        ];
    }
}
