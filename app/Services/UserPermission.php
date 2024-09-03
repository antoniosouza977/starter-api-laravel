<?php

namespace App\Services;

class UserPermission
{

    public static function canAccess(string $route): bool
    {
        $user = auth()->user();
        $user->load('roles.permissions');

        foreach ($user->roles as $role) {
            if ($role->permissions->contains('name', $route)) {
                return true;
            }
        }

        return false;
    }

}
