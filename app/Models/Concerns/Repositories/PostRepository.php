<?php

namespace App\Models\Concerns\Repositories;

use App\Actions\Posts\PostActions;

trait PostRepository
{
    public static function actions(): PostActions
    {
        return new PostActions();
    }
}
