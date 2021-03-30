<?php

namespace App\Repositories\Contract;

interface NeilRepositoryInterface
{

    public function all($field = ['*']);
    public function update($field = [null], $where = [null]);
    public function dec_n($field, $valor, $where = [null]);
    public function decUser($field, $valor, $where = [null]);
    public function get($field = [null], $where = [null]);
    public function create($field = [null]);
    public function delivery($field = [null]);
    public function delete($id);

   

}