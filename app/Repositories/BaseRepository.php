<?php

namespace App\Repositories;

class  BaseRepository implements RepositoryInterface {

    protected $model;
    public function __construct($model){
        $this->model=$model;
    }

    public function create($attributes)
    {
        return $this->model->create($attributes);

    }
    public function update($id, $attributes)
    {
        return $this->model->find($id)->update($attributes);
    }
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
    public function findById($id)
    {
        return $this->model->find($id);
    }


}