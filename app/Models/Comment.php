<?php

namespace App\Models;

use App\Models\Concerns\PostRelationship;
use App\Models\Concerns\Repositories\CommentRepository;
use App\Models\Concerns\UserRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    use UserRelationship;
    use PostRelationship;
    use CommentRepository;

    protected $fillable = [
        'user_id',
        'comment'
    ];
}
