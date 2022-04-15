<?php declare(strict_types=1);

namespace App\Console\Resource;

use Infrastructure\Hydrator\UserHydrator;
use Whirlwind\Infrastructure\Http\Response\Serializer\Json\JsonResource;

class UserResource extends JsonResource
{
    protected array $exclude = ['passwordHash'];

    public function __construct(UserHydrator $extractor)
    {
        parent::__construct($extractor);
    }
}
