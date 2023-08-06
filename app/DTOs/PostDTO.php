<?php
namespace App\DTOs;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Optional;

class PostDTO extends Data
{   
        public int | Optional $id;
        public string | Optional $title;
        public string | Optional $body;
        public int | Optional $user_id;
}