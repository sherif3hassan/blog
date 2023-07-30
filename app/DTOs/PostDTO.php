<?php
namespace App\DTOs;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Max;

class PostDTO extends Data
{
    public function __construct(
        public ?int $id, // Make the id property nullable
        #[Max(255)]
        public string $title,
        public string $body
    ) {
    }
}
