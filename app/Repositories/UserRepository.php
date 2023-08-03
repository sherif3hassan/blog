<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository{
 

    public function __construct(User $model){
        parent::__construct($model);
    }
    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }
   
}