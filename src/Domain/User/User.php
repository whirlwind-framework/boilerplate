<?php declare(strict_types=1);

namespace Domain\User;

use Whirlwind\Domain\Entity\CreatedAtInterface;
use Whirlwind\Domain\Entity\IdentityInterface;

final class User implements IdentityInterface, CreatedAtInterface
{
    protected $id;

    protected $email;

    protected $firstName;

    protected $lastName;

    protected $passwordHash;

    protected $isActive;

    protected $createdAt;

    public function __construct(string $id, string $email, string $firstName, string $lastName, string $passwordHash)
    {
        $this->id = $id;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->passwordHash = $passwordHash;
        $this->isActive = false;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setActive(): void
    {
        $this->isActive = true;
    }

    public function setInActive()
    {
        $this->isActive = false;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
