<?php

namespace App\Models\Concerns\Repositories;

use App\Actions\Interactions\CommentActions;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Arr;

trait CommentRepository
{
    public static function actions(): CommentActions
    {
        return new CommentActions();
    }

    public static function storeOrUpdate(array $data, Post $post, ?Comment $comment = null): Post
    {
        $model = $comment ?? new Comment();
        $model->comment = Arr::get($data, 'comment');
        $model->post_id = $post->getKey();
        $model->user_id = auth()->id() ?? 1;
        $model->save();

        return $post;
    }
}
