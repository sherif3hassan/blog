<?php

namespace App\DTOs;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UserDTO extends Data
{
    public int | Optional $id;
    public string | Optional $name;
    public string  $email;
    public string $password;
}
