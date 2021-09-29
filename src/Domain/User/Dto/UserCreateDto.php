<?php declare(strict_types=1);

namespace Domain\User\Dto;

use Whirlwind\Domain\Dto\Dto;

class UserCreateDto extends \Whirlwind\Domain\Dto\Dto
{
    protected $email;

    protected $firstName;

    protected $lastName;

    protected $password;

    protected $passwordVerify;

    public function getEmail(): string
    {
        return (string)$this->email;
    }

    public function getFirstName(): string
    {
        return (string)$this->firstName;
    }

    public function getLastName(): string
    {
        return (string)$this->lastName;
    }

    public function getPassword(): string
    {
        return (string)$this->password;
    }

    public function getPasswordVerify(): string
    {
        return (string)$this->passwordVerify;
    }
}
