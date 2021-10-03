<?php

namespace App\Actions\Interactions;

use App\Models\Interaction;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class InteractionActions
{
    public function storeOrUpdate(array $data, Post $post): Post
    {
        return Interaction::storeOrUpdate($data, $post);
    }
}
