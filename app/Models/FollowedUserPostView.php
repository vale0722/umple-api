<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static followedPost(int $int)
 */
class FollowedUserPostView extends Model
{
    public $table = 'followed_posts_view';

    public function scopeFollowedPost(Builder $query, int $userId): Builder
    {
        return $query->whereHas('user', function ($query) use ($userId){
            return $query->followedByUser($userId);
        })->with('user');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
