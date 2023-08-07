<?php

namespace App\Services;

use App\DTOs\PostDTO;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Log;

class PostService
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function create(PostDTO $postDTO)
    {
        $postDTO->user_id = Auth::id();
        return $this->postRepository->create($postDTO);
    }

    // get event by id 
    public function findById(int $id)
    {
        return $this->postRepository->findById($id);
    }


    public function update(PostDTO $postDTO, int $id)
    {
        $post = $this->postRepository->findById($id);
        if(!$post)
        {
            throw new ModelNotFoundException('Post not found');
        }
        if (auth()->user()->cannot('update', $post)) {
            throw new \Exception('unauthorized');
        }
        return $this->postRepository->update($id, $postDTO);
    }

    public function delete(int $id): void
    {
        $post = $this->postRepository->findById($id);
        if (!$post) {
            throw new ModelNotFoundException('Post not found');
        }
        

            // use policy to check if user is authorized to delete post
        if (auth()->user()->cannot('delete', $post)) {
            throw new \Exception('unauthorized');
        }
        $this->postRepository->delete($post);
    }


    // public function isPostOwnedByUser(int $postId): bool
    // {
    //     $post = $this->postRepository->findById($postId);

    //     if (!$post) {
    //         return false;
    //     }

    //     return Auth::id() === $post->user_id;
    // }
}
