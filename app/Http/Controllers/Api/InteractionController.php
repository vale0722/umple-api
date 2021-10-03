<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Interaction;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    public function interaction(Request $request, Post $post): JsonResponse
    {
       $post = Interaction::actions()->storeOrUpdate($request->toArray(), $post);

       return response()->json([
           'post' => $post
       ]);
    }

    public function comment(Request $request, Post $post): JsonResponse
    {
        $post = Comment::actions()->storeOrUpdate($request->toArray(), $post);

        return response()->json([
            'post' => $post
        ]);
    }
}
