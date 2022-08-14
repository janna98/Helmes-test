<?php

namespace App\Services;

use App\Models\User;

final class UserService
{

    public function __construct()
    {
    }

    public function add($name): User
    {
        $user = new User();
        $user->name = $name;
        $user->agreed_to_terms = true;
        $user->save();
        return $user;
    }

    public function exists($name): bool {
        return User::where('name', $name)->exists();
    }
}

