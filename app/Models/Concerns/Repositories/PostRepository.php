<?php

namespace App\Models\Concerns\Repositories;

use App\Actions\Interactions\InteractionActions;

trait PostRepository
{
    public static function actions(): InteractionActions
    {
        return new InteractionActions();
    }
}
