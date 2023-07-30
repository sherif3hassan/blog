<?php
namespace App\Http\Controllers;

// laravel data
//authentication 
//dto validator
use App\DTOs\PostDTO ;
use App\Http\Controllers\Controller;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $PostService;

    public function __construct(PostService $PostService)
    {
        $this->PostService = $PostService;
    }

    public function store(Request $request)
    {
        $PostDTO= PostDTO::fromRequest($request);

        $Post = $this->PostService->create($PostDTO);

        return response()->json($Post, 201);
    }

    public function update(Request $request, int $id)
    {
        $PostDTO = new PostDTO();
        $PostDTO->title = $request->input('title');
        $PostDTO->body = $request->input('body');

        $Post = $this->PostService->update($PostDTO, $id);

        return response()->json($Post, 200);
    }

    public function destroy(int $id)
    {
        $this->PostService->delete($id);

        return response()->json(['message' => ' post deleted successfully'], 200);
    }
}
