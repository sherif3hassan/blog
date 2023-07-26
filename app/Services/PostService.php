<?php

namespace App\Services;

use App\DTOs\PostDTO;
use App\Http\Validators\PostValidator;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Log;

class PostService
{
    private $PostRepository;

    public function __construct(PostRepository $PostRepository)
    {
        $this->PostRepository = $PostRepository;
    }

    public function create(PostDTO $PostDTO)
    {
        //log in terminal $postDTO
        

        $data = [
            'title' => $PostDTO->title,
            'body' => $PostDTO->body,
        ];
        //log in terminal $data

        $validator = PostValidator::validate($data);
        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
        }

        return $this->PostRepository->create($data);
    }

    public function update(PostDTO $PostDTO, int $id)
    {
        $Post = $this->PostRepository->findById($id);

        $data = [
            'title' => $PostDTO->title,
            'body' => $PostDTO->body,
        ];

        $validator = PostValidator::validate($data);
        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
        }

        return $this->PostRepository->update($Post, $data);
    }

    public function delete(int $id)
    {
        $Post = $this->PostRepository->findById($id);
        $this->PostRepository->delete($Post);
    }
}
