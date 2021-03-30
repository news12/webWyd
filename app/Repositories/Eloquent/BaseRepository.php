<?php


namespace App\Repositories\Eloquent;
use Illuminate\Support\Facades\DB;

abstract class BaseRepository 
{

    protected $model;

    public function __construct()
    {
        $this->model = $this->resolvModel();
    }

    public function all()
    {
       return $this->model->All(); 
    }

    public function get($table, $fields = ['*'], $where = [null])
    {
        $data = DB::table($table['table'])
        ->select($fields)
        ->where($where)
        ->get();

        return $data;
    }
    

    public function update($table, $fields = ['*'], $where = [null])
    {

         $data = DB::table($table['table'])
         ->where($where)
         ->update($fields);
         
        return $data;
    }

    public function delete($id)
    {
      return $this->model->destroy($id);
    }

    public function dec($table, $field, $value, $where = [null])
    {
        
        $data = DB::table($table['table'])
        ->where($where)
        ->decrement($field, $value);

        return $data;

    }

    public function inc($table, $field, $value, $where = [null])
    {
        $data = DB::table($table['table'])
        ->where($where)
        ->increment($field, $value);

        return $data;

    }

    public function count($table, $field, $where = [null])
    {
        $data = DB::table($table['table'])
        ->select($field)
        ->where($where)
        ->count();

        return $data;
    }

    public function remove($table, $where = [null])
    {
        //dd($table, $where);
        $data = DB::table($table['table'])
        ->where($where)
        ->delete();

        return $data;
    }





    protected function resolvModel()
    {

        return app($this->model);

    }



}