<?php

namespace App\Repositories\Contract;

interface StorageRepositoryInterface
{

    public function all($table, $field = ['*']);
    public function getStorage($field = ['*'], $where = [null]);
    public function update($field = [null], $where = [null]);
    public function nCount($field = ['*'],$where = [null]);
    public function nGetStatus($field = ['*'],$where = [null]);
    public function nGet($table, $field = ['*'], $id);
   

}