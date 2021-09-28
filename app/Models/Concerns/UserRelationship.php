<?php

namespace App\Models\Concerns;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserRelationship
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
