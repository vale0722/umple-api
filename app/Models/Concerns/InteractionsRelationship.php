<?php

namespace App\Models\Concerns;

use App\Models\Comment;
use App\Models\Interaction;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait InteractionsRelationship
{
    public function interactions(): HasMany
    {
        return $this->hasMany(Interaction::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
