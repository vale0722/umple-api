<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $token = auth()->attempt($request->toArray());

        return $token
            ? $this->respondWithToken($token)
            : response()->json(['error' => 'Unauthorized'], 401);
    }

    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Sesión finalizada exítosamente']);
    }

    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create(array_merge($request->validated(), ['password' => bcrypt($request->get('password'))]));

        return response()->json(["message" => "Usuario registrado exitosamente", "user" => $user], 201);
    }
}
