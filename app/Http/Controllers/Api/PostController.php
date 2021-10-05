<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrUpdatePostRequest;
use App\Models\FollowedUserPostView;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        $posts = FollowedUserPostView::followedPost(1)->orderByDesc('date')->get();
        return response()->json(compact('posts'));
    }

    public function store(StoreOrUpdatePostRequest $request): JsonResponse
    {
        return response()->json([
            'post' => Post::actions()->storeOrUpdate($request->validated())->getModel(),
            'message' => trans('posts.store_successful')
        ]);
    }

    public function update(StoreOrUpdatePostRequest $request, Post $post): JsonResponse
    {
        return response()->json([
            'post' => Post::actions()->storeOrUpdate($request->validated(), $post)->getModel(),
            'message' => trans('posts.update_successful')
        ]);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json([
            'message' => trans('posts.delete_successful')
        ]);
    }
}
