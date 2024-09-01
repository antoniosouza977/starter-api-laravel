<?php

namespace App\Validators;

use Illuminate\Contracts\Validation\Factory;
use Prettus\Validator\AbstractValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class BaseValidator extends AbstractValidator
{

    /**
     * Validator
     *
     * @var \Illuminate\Validation\Factory
     */
    protected $validator;

    public function __construct(Factory $validator)
    {
        $this->validator = $validator;
    }

    public function passes($action = null): bool
    {
        $rules = $this->getRulesList($action);
        $messages = $this->getMessages();
        $attributes = $this->getAttributes();
        $validator = $this->validator->make($this->data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            $this->errors = $validator->messages();
            return false;
        }

        return true;
    }

    public function getRulesList($action): array
    {
        if ($action === ValidatorInterface::RULE_UPDATE) {
            return $this->updateRules();
        }

        return $this->createRules();
    }

    protected function createRules(): array
    {
        return [];
    }

    protected function updateRules(): array
    {
        return [];
    }
}
