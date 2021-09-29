<?php declare(strict_types=1);

namespace App\Api\Action\User;

use App\Api\Http\Response\Serializer;
use App\Api\Service\UserService;
use Domain\User\Exception\UserUniqueException;
use Domain\User\User;
use Psr\Http\Message\ResponseFactoryInterface;
use Whirlwind\App\Action\Action;
use Whirlwind\Domain\Validation\Exception\ValidateException;

class UserCreateAction extends Action
{
    protected UserService $service;

    public function __construct(UserService $service, ResponseFactoryInterface $responseFactory, Serializer $serializer)
    {
        $this->service = $service;
        parent::__construct($responseFactory, $serializer);
    }

    protected function action()
    {
        try {
            $this->response = $this->response->withStatus(201);
            return $this->service->create($this->request);
        } catch (UserUniqueException $e) {
            $this->response = $this->response->withStatus(409);
            return ['error' => 'User with this email already exist'];
        } catch (ValidateException $e) {
            $this->response = $this->response->withStatus(422);
            return $e->getErrorCollection();
        } catch (\InvalidArgumentException $e) {
            $this->response = $this->response->withStatus(400);
            return ['error' => $e->getMessage()];
        }
    }
}
