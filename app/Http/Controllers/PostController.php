<?php

namespace App\Http\Controllers;

use App\DTOs\PostDTO;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Services\PostService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        
        
        $postDTO= PostDTO::from($request->validated());
        $postDTO->author_id = auth()->id();
        $post = $this->postService->create($postDTO);
        return response()->json($post, 201);


    }

    // get request to get event by id
    public function show(int $id): JsonResponse
    {
        $post = $this->postService->findById($id);

        if($post)
        {
            return response()->json($post, 200);
        }
        else
        {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }


    public function update(UpdatePostRequest $request, int $id): JsonResponse
    {
        $postDTO= PostDTO::from($request->validated());
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
