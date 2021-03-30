<?php

namespace App\Repositories\Contract;

interface NewsRepositoryInterface
{

    public function all($field = ['*']);
    public function update($field = [null], $where = [null]);
    public function create($field = [null]);
    public function delete($id);

   

}