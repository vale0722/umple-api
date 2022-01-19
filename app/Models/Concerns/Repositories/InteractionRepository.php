<?php

namespace App\Models\Concerns\Repositories;

use App\Actions\Interactions\InteractionActions;
use App\Constants\InteractionTypes;
use App\Models\Interaction;
use App\Models\Post;
use App\Notifications\NewInteraction;
use Illuminate\Support\Arr;

trait InteractionRepository
{
    public static function actions(): InteractionActions
    {
        return new InteractionActions();
    }

    public static function storeOrUpdate(array $data, Post $post): Post
    {
        $interaction = $post->interactions()->where('user_id', auth()->id())->first();
        if($interaction) {
            $interaction->delete();
            NewInteraction::dispatch(null, $post);
        } else {
            $interaction = $post->interactions()->create(['user_id' => auth()->id(), 'type' => InteractionTypes::LIKE]);
            NewInteraction::dispatch($interaction, $post);
        }

        return $post;
    }
}
