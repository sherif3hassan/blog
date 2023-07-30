<?php

namespace App\Http\Controllers;

use App\DTOs\PostDTO;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function store(PostDTO $postDTO): JsonResponse
    {
        $post = $this->postService->create($postDTO);

        return response()->json($post, 201);
    }

    public function update(PostDTO $postDTO, int $id): JsonResponse
    {
        $post = $this->postService->update($postDTO, $id);
        
        if($post)
        {
            return response()->json($post, 200);
        }
        else
        {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }
    public function destroy(int $id): JsonResponse
    {
        $this->postService->delete($id);

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
