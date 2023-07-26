<?php

namespace App\Http\Validators;

use Illuminate\Support\Facades\Validator;
class PostValidator
{
    public static function validate(array $data)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ];

        $messages = [
            // Custom error messages if needed.
        ];

        return Validator::make($data, $rules, $messages);
    }
}

