<?php

namespace App\Validators;

use Illuminate\Validation\Rule;

class UserValidator extends BaseValidator
{

    protected function updateRules(): array
    {
        $user = auth()->user();
        return [
            'name'     => 'string|min:3',
            'username' => [
                'string', 'min:3', 'confirmed',
                Rule::unique('users')->ignore($user->id)],
            'email'    => [
                'email',
                Rule::unique('users')->ignore($user->id),],
            'password' => 'string|between:8,255|confirmed',
        ];
    }

    protected function createRules(): array
    {
        return [
            'name'     => 'required|min:3',
            'username' => 'required|min:3|unique:users,username|confirmed',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|between:8,255|confirmed',
        ];
    }
}
