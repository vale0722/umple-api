<?php

namespace App\Models;

use App\Models\Concerns\InteractionsRelationship;
use App\Models\Concerns\Repositories\PostRepository;
use App\Models\Concerns\UserRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static followedPost(int $userId)
 * @property string photo_url
 * @property string content
 */
class Post extends Model
{
    use HasFactory;
    use UserRelationship;
    use InteractionsRelationship;
    use PostRepository;

    public function getPhotoUrl(): string
    {
        return $this->photo_url;
    }

    public function setPhotoUrl(string $photoUrl): void
    {
        $this->photo_url = $photoUrl;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(?string $content): void
    {
        $this->content = $content;
    }
}
