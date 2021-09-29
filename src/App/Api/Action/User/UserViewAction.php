<?php declare(strict_types=1);

namespace App\Api\Action\User;

use App\Api\Http\Response\Serializer;
use Domain\User\Exception\UserNotFoundException;
use Domain\User\User;
use App\Api\Service\UserService;
use League\Route\Http\Exception\BadRequestException;
use League\Route\Http\Exception\NotFoundException;
use Psr\Http\Message\ResponseFactoryInterface;
use Whirlwind\App\Action\Action;

class UserViewAction extends Action
{
    protected UserService $service;

    public function __construct(UserService $service, ResponseFactoryInterface $responseFactory, Serializer $serializer)
    {
        $this->service = $service;
        parent::__construct($responseFactory, $serializer);
    }

    protected function action(): User
    {
        if (!isset($this->args['id'])) {
            throw new BadRequestException();
        }
        try {
            $user = $this->service->getUser($this->args['id']);
        } catch (UserNotFoundException $e) {
            throw new NotFoundException();
        }
        return $user;
    }
}
