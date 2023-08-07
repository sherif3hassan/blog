<?php

namespace App\Http\Controllers;

use App\DTOs\PostDTO;
use App\Services\PostService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Exception;
use Illuminate\Http\Response;

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
        return response()->json($post, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
        $post = $this->postService->findById($id);

        if ($post) {
            return response()->json($post, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Post not found'], Response::HTTP_NOT_FOUND);
        }
    }


    public function update(UpdatePostRequest $request, Post $post)
    {
        //
        try {
            $postDTO = PostDTO::from($request->validated());
            $post = $this->postService->update($postDTO, $post->getKey());

            return response()->json($post, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Post not found'], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            if ($e->getMessage() === 'unauthorized') {
                return response()->json(['message' => 'You are not authorized to update this post'], Response::HTTP_FORBIDDEN);
            }
            return response()->json(['message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $this->postService->delete($id);

            return response()->json(['message' => 'Post deleted successfully'], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Post not found'], Response::HTTP_NOT_FOUND);
        } catch (Exception $e) {
            if ($e->getMessage() === 'unauthorized') {
                return response()->json(['message' => 'You are not authorized to delete this post'], 403);
            }
        }
    }
}

