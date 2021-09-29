<?php declare(strict_types=1);

namespace App\Api\Action\User;

use App\Api\Http\Response\Serializer;
use Domain\User\UserCollection;
use App\Api\Service\UserService;
use Psr\Http\Message\ResponseFactoryInterface;
use Whirlwind\App\Action\Action;

class UserIndexAction extends Action
{
    protected UserService $service;

    public function __construct(UserService $service, ResponseFactoryInterface $responseFactory, Serializer $serializer)
    {
        $this->service = $service;
        parent::__construct($responseFactory, $serializer);
    }

    protected function action(): UserCollection
    {
        return $this->service->getUsers($this->request);
    }
}
