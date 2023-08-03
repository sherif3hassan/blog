<?php
namespace App\Services;

use App\DTOs\UserDTO;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserDTO $userDTO): void
    {
        $userDTO->password = Hash::make($userDTO->password);
        $this->userRepository->create($userDTO);
    }

    public function login(UserDTO $userDTO): ?string
    {
        $user = $this->userRepository->findByEmail($userDTO->email);
        if (!$user || !Hash::check($userDTO->password, $user->password)) {
            return null;
        }
        // auth()->login($user);


        return JWTAuth::fromUser($user);
    }

    public function logout(): void
    {
        auth()->logout();
    }
}
