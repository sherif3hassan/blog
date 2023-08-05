<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        
    }

    // register
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'email|required',
            'password' => 'required|min:6'
        ]);
        
        $validatedData['password'] = bcrypt($request->password);
        
        $user = User::create($validatedData);
        
        // $accessToken = $user->createToken('authToken')->accessToken;
        $token=Auth::login($user);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Register Success',
            'user' => $user,
            'token' => $token
        ]);
    
    }

    // login
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $token=Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'login failed'
            ]);
        }
        
        // $accessToken = Auth::user()->createToken('authToken')->accessToken;
        
        return response()->json([
            'status' => 'success',
            'message' => 'Login Success',
            // 'user' => Auth::user(),
            'token' => $token
        ]);
    
    }
}
