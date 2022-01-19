<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewComment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('App.Models.Comments.' . $this->comment->post->user_id);
    }

    public function broadcastAs(): string
    {
        return 'new-comment';
    }

    public function broadcastWith(): array
    {
        return [
            'user_profile' => $this->comment->user->photo_uri,
            'user_name' => $this->comment->user->name,
            'user_id' =>  $this->comment->user_id,
            'post_id' =>  $this->comment->post_id,
            'type' =>  'a comendado tu publicación',
            'date' => $this->comment->created_at
        ];
    }


}
