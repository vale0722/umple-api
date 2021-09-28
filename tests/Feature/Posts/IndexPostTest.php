<?php

namespace Posts;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class IndexPostTest extends TestCase
{
    public const INDEX_ROUTE = 'api.posts.index';

    /**
     * @test
     */
    public function userCanGetFollowedPosts()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();
        $user->followed()->attach([
            'follower_id' => $userB->id
        ]);

        $posts = Post::factory(4)->create([
            'user_id' => $userB->id
        ])->load('user');

        $response = $this->actingAs($user)->getJson(route(self::INDEX_ROUTE, $user));

        $response->assertOk();

        $postsResponse = $response->getOriginalContent()['posts'];
        $this->assertNotEmpty($postsResponse);
        $this->assertEquals($postsResponse->toArray(), $posts->toArray());
    }
}
