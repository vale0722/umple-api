<?php

namespace App\Actions\Interactions;

use App\Models\Comment;
use App\Models\Post;

class CommentActions
{
    public function storeOrUpdate(array $data, Post $post, Comment $comment = null): Post
    {
        return Comment::storeOrUpdate($data, $post, $comment);
    }
}
