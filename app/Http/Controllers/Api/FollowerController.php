<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrUpdatePostRequest;
use App\Models\FollowedUserPostView;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class FollowerController extends Controller
{
    public function indexFollowed(): JsonResponse
    {
        $followed = User::followedByUser(auth()->id())->orderBy('name')->get();
        return response()->json(compact('followed'));
    }

    public function indexFollowers(): JsonResponse
    {
        $followers = User::followersByUser(auth()->id())->orderBy('name')->get();
        return response()->json(compact('followers'));
    }

    public function indexNotFollowed(): JsonResponse
    {
        $notFollowed = User::notFollowedByUser(auth()->id())
            ->orderBy('name')
            ->limit(10)
            ->get();

        return response()->json(compact('notFollowed'));
    }

    public function store(User $user): JsonResponse
    {
        User::actions()->storeFollowed(auth()->user(), $user);

        return response()->json([
            'message' => trans('followed.store_successful')
        ]);
    }
}
