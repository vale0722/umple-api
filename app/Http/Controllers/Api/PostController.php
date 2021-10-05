<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrUpdatePostRequest;
use App\Models\FollowedUserPostView;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $posts = FollowedUserPostView::followedPost(1)->orderByDesc('date')->get();
        } catch (\Throwable $exception) {
            $posts = [];
        }

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
        if($post->photo_url) {
            Storage::disk('s3')->delete($post->photo_url);
        }

        $post->delete();

        return response()->json([
            'message' => trans('posts.delete_successful')
        ]);
    }
}
