<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class  BaseRepository implements RepositoryInterface {

    protected Model $model;
    public function __construct($model){
        $this->model=$model;
    }

    public function create($attributes)
    {
        return $this->model->create($attributes);

    }
    public function update($id, $attributes)
    {
        if($this->model->find($id)->update($attributes))
        {
            return $this->model->find($id);
        }
        else
        {
            return null;
        }
    }
    public function delete($id)
    {
        return $this->model->find($id)->each->delete();
    }
    public function findById($id)
    {
        return $this->model->find($id);
    }


}