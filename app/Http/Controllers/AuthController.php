<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\DTOs\UserDTO;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use Tymon\JWTAuth\JWT;

class AuthController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('auth:api', ['except' => ['register', 'login']]);
    }

    public function register(RegisterUserRequest $request)
    {
        $userDTO= UserDTO::from($request->validated());

        $this->userService->register($userDTO);
        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function login(LoginUserRequest $request)
    {
        $userDTO= UserDTO::from($request->validated());
        if (!$token = $this->userService->login($userDTO)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        $this->userService->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        $expiresIn = JWTAuth::factory()->getTTL() * 60;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $expiresIn,
        ]);
    }
}
