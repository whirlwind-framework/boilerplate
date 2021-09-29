<?php declare(strict_types=1);

namespace App\Api\Http\Response;

use App\Api\Resource\UserResource;
use Domain\User\User;
use Whirlwind\Infrastructure\Http\Response\Serializer\Json\JsonSerializer;

class Serializer extends JsonSerializer
{
    protected array $decorators = [
        User::class => UserResource::class
    ];
}
