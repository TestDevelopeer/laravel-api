<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginUserRequest;
use App\Http\Requests\V1\StoreUserRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\V1\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        return User::create($request->all());
    }

    public function login(LoginUserRequest $request): JsonResponse
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'message' => 'Wrong email or password'
            ], 401);
        }

        $user = Auth::user();
        $user->tokens()->delete();

        return response()->json([
            'user' => new UserResource($user),
            'access_token' => $user->createToken('Personal Access Token')->plainTextToken,
        ]);
    }

    public function logout(): JsonResponse
    {
        Auth::user()->tokens()->delete();
        Auth::logout();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }
}
