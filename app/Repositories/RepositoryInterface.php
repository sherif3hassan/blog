<?php

namespace App\Repositories;

use Spatie\LaravelData\Data;

interface RepositoryInterface{

    public function create(Data $data);
    public function update($id, Data $data);
    public function delete($id);


}