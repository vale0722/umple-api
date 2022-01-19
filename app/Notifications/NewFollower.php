<?php

namespace App\Notifications;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewFollower implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private User $follower;
    private User $followed;
    private bool $unfollow;

    public function __construct(User $follower, User $followed, bool $unfollow = false)
    {
        $this->follower = $follower;
        $this->followed = $followed;
        $this->unfollow = $unfollow;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('App.Models.Followed.' . $this->followed->id);
    }

    public function broadcastAs(): string
    {
        return 'new-followed';
    }

    public function broadcastWith(): array
    {
        return $this->unfollow ? [
            'user_profile' => $this->follower->photo_uri,
            'user_name' => $this->follower->name,
            'user_id' =>  $this->follower->id,
            'type' =>  'a dejado de seguirte'
        ]: [
            'user_profile' => $this->follower->photo_uri,
            'user_name' => $this->follower->name,
            'user_id' =>  $this->follower->id,
            'type' =>  'a empezado a seguirte'
        ];
    }


}
