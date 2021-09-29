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
            'email' => isset($data['email']) ? $data['email'] : '',
            'firstName' => isset($data['firstName']) ? $data['firstName'] : '',
            'lastName' => isset($data['lastName']) ? $data['lastName'] : '',
            'password' => isset($data['password']) ? $data['password'] : '',
            'passwordVerify' => isset($data['password2']) ? $data['password2'] : '',
        ];
    }
}
