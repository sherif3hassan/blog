<?php

namespace App\Http\Controllers;
use App\DTOs\PostDTO;
use App\Services\PostService;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController  extends Controller
{
    
    private $postService;
    
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
   
    public function store(StorePostRequest $request)
    {
        // //
        $postDTO= PostDTO::from($request->validated());
        $post = $this->postService->create($postDTO);
        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
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

  
    public function update(UpdatePostRequest $request, int $id)
    {
        //
        
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        //
        $this->postService->delete($id);

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
