<?php

namespace App\Services;


use App\DTOs\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmation;

class AuthService
{
    // User registration
public function register(UserDTO $userDTO)
    {
        $user = User::create([
            'name' => $userDTO->name,
            'email' => $userDTO->email,
            'password' => Hash::make($userDTO->password),
        ]);
        if($user){
            Mail::to($user->email)->send(new RegistrationConfirmation($user->name));
        }
        return  $user;
    }

    // User login
    public function login(UserDTO $userDTO)
    {
        $credentials = $userDTO->toArray();
        $token = auth()->attempt($credentials);
        if (!$token){
            throw new \Exception('Invalid credentials');
        }
        return $token;
    }

    // User logout
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Logged out successfully']);
    }

    // Get authenticated user details
    public function me()
    {
        return response()->json(auth()->user());
    }
}
