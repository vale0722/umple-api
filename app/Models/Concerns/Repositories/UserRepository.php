<?php

namespace App\Models\Concerns\Repositories;

use  Illuminate\Database\Eloquent\Builder;

trait UserRepository
{
    public function scopeFollowedByUser(Builder $query, int $userId): Builder
    {
        return $query->whereHas('followers', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        });
    }
}
