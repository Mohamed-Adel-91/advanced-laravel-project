<?php
namespace App\Services;

use App\Models\User;

class UserServices
{
    public function createUser(array $user):User
    {
        return User::create($user);
    }
}
