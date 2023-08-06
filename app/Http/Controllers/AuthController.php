<?php
namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\DTOs\UserDTO;
use App\Services\AuthService;

class AuthController extends Controller
{
    private $authService;
    
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }


    // User registration
    public function register(RegisterRequest $request)
    {
        $userDTO= UserDTO::from($request->validated());
        $user = $this->authService->register($userDTO);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
    }

    // User login
    public function login(LoginRequest $request)
    {
        $userDTO= UserDTO::from($request->validated());
        try {
            $token = $this->authService->login($userDTO);
            return response()->json(['token' => $token]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    // User logout
    public function logout()
    {
        $this->authService->logout();
        return response()->json(['message' => 'Logged out successfully']);
    }

    // Get authenticated user details
    public function me()
    {
        return $this->authService->me();
    }
}
