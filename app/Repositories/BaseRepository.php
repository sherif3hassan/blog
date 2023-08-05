<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Data;

class  BaseRepository implements RepositoryInterface {

    protected Model $model;
    public function __construct($model){
        $this->model=$model;
    }

    public function create(Data $data)
    {
        return $this->model->create($data->toArray());

    }
    public function update($id, $data)
    {
        if($this->model->find($id)->update($data->toArray()))
        {
            return $this->model->find($id);
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

    public function all()
    {
        return $this->model->all();
    }



}