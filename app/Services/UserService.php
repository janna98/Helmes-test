<?php

namespace App\Services;

use App\Models\User;

final class UserService
{
    public function add($name): User
    {
        $user = new User();
        $user->name = $name;
        $user->agreed_to_terms = true;
        $user->save();
        return $user;
    }

    public function update($id, $name): void
    {
        $user = User::where('id', $id)->first();
        $user->name = $name;
        $user->save();
    }
}

