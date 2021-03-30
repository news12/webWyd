<?php

namespace App\Repositories\Contract;

interface SaleRepositoryInterface
{

    public function all($table, $field = ['*']);
    public function all_n($table, $city);
    public function create($table, $fields = [null], $city);
    public function nCount($table, $fields = ['*'], $where = [null]);
    public function nUpdate($table, $fields = ['*'], $where = [null]);
   

}