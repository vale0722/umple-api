<?php

namespace App\Models\Concerns\Repositories;

use App\Actions\Interactions\UserActions;
use App\Models\User;
use  Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

trait UserRepository
{
    public static function actions(): UserActions
    {
        return new UserActions();
    }

    public function scopeFollowedByUser(Builder $query, int $userId): Builder
    {
        return $query->whereHas('followers', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        });
    }

    public function scopeFollowersByUser(Builder $query, int $userId): Builder
    {
        return $query->whereHas('followers', function ($query) use ($userId) {
            $query->where('follower_id', $userId);
        });
    }

    public function scopeNotFollowedByUser(Builder $query, int $userId): Builder
    {
        return $query->whereDoesntHave('followers', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->whereKeyNot($userId);
    }

    public static function storeFollowed(User $user, User $followed)
    {
        if ($followedUser = $user->followed()->where('follower_id', $followed->getKey())->first()) {
            $followedUser->followers()->detach($user->getKey());
        } else {
            $user->followed()->attach($followed->getKey());
        }

        return $user;
    }
}
