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
        $posts = FollowedUserPostView::followedPost(12)->orderByDesc('date')->get();
        Log::info(asset('storage/posts/tk_n_c0_y_ql_rhdzdsh_rho1xk_g_f4_e3_ru_ko_ik_t_g_x3p_sq5.png'));
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
