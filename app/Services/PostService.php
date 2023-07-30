<?php

namespace App\Services;

use App\DTOs\PostDTO;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Log;

class PostService
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function create(PostDTO $postDTO): Post
    {
        //log the $postDTO if needed
        Log::info($postDTO);

        $data = [
            'title' => $postDTO->title,
            'body' => $postDTO->body,
        ];

        // You can perform additional business logic or validation if needed

        return $this->postRepository->create($data);
    }

    public function update(PostDTO $postDTO,int $id): Post
    {
        // Check if the id property is null, which means we are creating a new post
        if ($id === null) {
            throw new \InvalidArgumentException('Cannot update post without an id.');
        }

        $data = [
            'title' => $postDTO->title,
            'body' => $postDTO->body,
        ];

        return $this->postRepository->update($id, $data);
    }

    public function delete(int $id): void
    {
        $post = $this->postRepository->findById($id);
        $this->postRepository->delete($post);
    }
}
