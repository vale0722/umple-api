<?php

namespace App\Actions\Posts;

use Illuminate\Database\Eloquent\Model;

class PostActions
{
    public function storeOrUpdate(array $data, Model $model = null): StoreOrUpdatePost
    {
        return (new StoreOrUpdatePost($data, $model))->execute();
    }
}
