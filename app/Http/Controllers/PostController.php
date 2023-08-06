<?php

namespace App\Http\Controllers;

use App\DTOs\PostDTO;
use App\Services\PostService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Exception;

class PostController  extends Controller
{

    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function store(StorePostRequest $request)
    {
        $postDTO = PostDTO::from($request->validated());
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

        if ($post) {
            return response()->json($post, 200);
        } else {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }


    public function update(UpdatePostRequest $request, int $id)
    {
        //
        try {
            $postDTO = PostDTO::from($request->validated());
            $post = $this->postService->update($postDTO, $id);

            return response()->json($post, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Post not found'], 404);
        } catch (Exception $e) {
            if ($e->getMessage() === 'unauthorized') {
                return response()->json(['message' => 'You are not authorized to update this post'], 403);
            }
            return response()->json(['message' => $e->getMessage()], 500);
        }

        // $postDTO= PostDTO::from($request->validated());
        // $post = $this->postService->update($postDTO, $id);

        // if($post)
        // {
        //     return response()->json($post, 200);
        // }
        // else
        // {
        //     return response()->json(['message' => 'Post not found'], 404);
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $this->postService->delete($id);

            return response()->json(['message' => 'Post deleted successfully'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Post not found'], 404);
        } catch (Exception $e) {
            if ($e->getMessage() === 'unauthorized') {
                return response()->json(['message' => 'You are not authorized to delete this post'], 403);
            }
        }
    }
}

