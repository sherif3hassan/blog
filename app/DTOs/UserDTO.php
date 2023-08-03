<?php
namespace App\DTOs;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Optional;
use Illuminate\Support\Facades\Hash;
use PhpOption\Option;

class UserDTO extends Data
{
    public function __construct(
        public int | Optional $id,
        public string | Optional $name,
        public string $email,
        public string $password 
    ) {
    }
}
