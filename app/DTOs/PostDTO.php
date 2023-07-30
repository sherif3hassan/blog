<?php
namespace App\DTOs;

use App\Models\Post;
use Illuminate\Http\Request;

class PostDTO{


    public $id;
    public $title;
    public $body;

    static function fromRequest(Request $request){
        $instance = new self();
        $data = $request->json()->all();
        $instance->title = $data['title'];
        $instance->body = $data['body'];
        return $instance;
    }
    static function fromModel(Post $model){
        $instance = new self();
        $instance->id = $model->id;
        $instance->title = $model->title;
        $instance->body = $model->body;
        return $instance;
    }

}