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
        // Set the id property of the $postDTO using the $id route parameter
        $postDTO->id = $id;

        $post = $this->postService->update($postDTO);

        return response()->json($post, 200);
    }
    public function destroy(int $id): JsonResponse
    {
        $this->postService->delete($id);

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
