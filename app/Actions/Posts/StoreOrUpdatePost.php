<?php

namespace App\Actions\Posts;

use App\Actions\StoreOrUpdateModel;
use App\Helpers\FilesHelper;
use App\Models\Post;
use Illuminate\Support\Arr;

class StoreOrUpdatePost extends StoreOrUpdateModel
{
    public function execute(): static
    {
        /** @var Post model */
        $this->model = $this->model ?? new Post();
        if (Arr::has($this->data, 'photo')) {
            $file = FilesHelper::save('posts', Arr::get($this->data, 'photo'));
            $this->model->setPhotoUrl($file);
        }
        $this->model->setContent(Arr::get($this->data, 'content'));
        $this->model->user()->associate(auth()->user());
        $this->model->save();

        return $this;
    }
}
