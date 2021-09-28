<?php

namespace Posts;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StorePostTest extends TestCase
{
    public const ROUTE = 'api.posts.store';

    /**
     * @test
     */
    public function userCanGetFollowedPosts()
    {
        Storage::fake('local');
        $user = User::factory()->create();
        $posts = Post::factory([
            'user_id' => $user
        ])->make()->toArray();

        $posts = Arr::set($posts, 'photo_url', UploadedFile::fake()->image($posts['photo_url']));

        $response = $this->actingAs($user)->postJson(route(self::ROUTE), $posts);
        $response->assertOk();
        $postsResponse = $response->getOriginalContent()['post'];
        $this->assertNotEmpty($postsResponse);
        $this->assertDatabaseHas('posts', ['id' => $postsResponse->id]);
    }
}
