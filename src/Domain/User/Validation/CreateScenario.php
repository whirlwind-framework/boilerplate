<?php declare(strict_types=1);

namespace Domain\User\Validation;

use Whirlwind\Domain\Validation\Scenario;
use Whirlwind\Domain\Validation\Factory\ValidatorFactory;
use Whirlwind\Domain\Validation\Factory\ValidatorCollectionFactory;

class CreateScenario extends Scenario
{
    public function __construct(
        ValidatorFactory $validatorFactory,
        ValidatorCollectionFactory $validatorCollectionFactory
    ) {
        $validationRules = [
            [['email', 'password', 'passwordVerify'], 'required'],
            [['email'], 'email']
        ];
        parent::__construct($validatorFactory, $validatorCollectionFactory, $validationRules);
    }

}
