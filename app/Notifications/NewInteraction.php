<?php

namespace App\Notifications;

use App\Models\Comment;
use App\Models\Interaction;
use App\Models\Post;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewInteraction implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private ?Interaction $interaction;
    private ?Post $post;

    public function __construct(?Interaction $interaction, Post $post)
    {
        $this->interaction = $interaction;
        $this->post = $post;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('App.Models.Interactions.' . $this->post->user_id);
    }

    public function broadcastAs(): string
    {
        return 'new-interaction';
    }

    public function broadcastWith(): array
    {
        return $this->interaction ? [
            'user_profile' => $this->interaction->user->photo_uri,
            'user_name' => $this->interaction->user->name,
            'user_id' =>  $this->interaction->user_id,
            'post_id' =>  $this->post->id,
            'type' =>  'a dado me gusta a tu publicación',
            'date' => $this->interaction->created_at
        ] : [
            'user_profile' => auth()->user()->photo_uri,
            'user_name' => auth()->user()->name,
            'user_id' =>  auth()->id(),
            'post_id' =>  $this->post->id,
            'type' =>  'ya no le gusta tu publicación',
        ];
    }


}
