<?php
namespace App\DTOs;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Optional;

class PostDTO extends Data
{
    public function __construct(
        // make id optional for create
        public int | Optional $id,
        public string $title,
        public string $body,
        public int $author_id
    ) {
    }
}
