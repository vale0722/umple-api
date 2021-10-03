<?php

namespace App\Models\Concerns\Repositories;

use App\Actions\Interactions\InteractionActions;
use App\Constants\InteractionTypes;
use App\Models\Interaction;
use App\Models\Post;
use Illuminate\Support\Arr;

trait InteractionRepository
{
    public static function actions(): InteractionActions
    {
        return new InteractionActions();
    }

    public static function storeOrUpdate(array $data, Post $post): Post
    {
        /** @var Interaction $interaction */
        $interaction = $post->interactions()->where('user_id', auth()->id() ?? 1)->first();

        $type = Arr::get($data, 'type', InteractionTypes::LIKE);

        if ($interaction) {
            if ($interaction->getType() === $type) {
                $interaction->delete();
            } else {
                $interaction->type = $type;
                $interaction->save();
            }
        } else {
            $post->interactions()->create(['user_id' => auth()->id() ?? 1, 'type' => $type]);
        }

        return $post;
    }
}
