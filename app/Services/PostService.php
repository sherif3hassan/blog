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
        return $this->postRepository->create($postDTO);
    }

    // get event by id 
    public function findById(int $id): Post
    {
        return $this->postRepository->findById($id);
    }




    public function update(PostDTO $postDTO,int $id): Post
    {
        return $this->postRepository->update($id, $postDTO);
    }

    public function delete(int $id): void
    {
        $post = $this->postRepository->findById($id);
        $this->postRepository->delete($post);
    }
}
