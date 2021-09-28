<?php

namespace App\Models\Concerns;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait PostRelationship
{
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
