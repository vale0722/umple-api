<?php

namespace App\Actions\Interactions;

use App\Models\User;

class UserActions
{
    public function storeFollowed(User $user, User $followed): User
    {
        return User::storeFollowed($user, $followed);
    }
}
