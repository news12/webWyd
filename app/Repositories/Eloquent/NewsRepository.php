<?php

namespace App\Repositories\Eloquent;

use App\Models\News;
use App\Repositories\Contract\NewsRepositoryInterface;
use Illuminate\Support\Facades\DB;

class NewsRepository implements NewsRepositoryInterface
{

    protected $model = News::class;
    protected $table_name = 'news';
 
    public function all($field = ['*'])
    {
    
        $data = DB::table($this->table_name)
                ->select($field)
                ->orderBy('date', 'desc')
                ->orderBy('hour', 'desc')
                ->get();

       return $data; 
    }

    public function create($fields = [null])
    {
        $data = new $this->model;
        $data->type = $fields['type'];
        $data->title = $fields['title'];
        $data->date = $fields['date'];
        $data->hour = $fields['hour'];
        $data->news = $fields['news'];
        $data->autor = $fields['autor'];
        $data->save();

        return $data;
    }


    public function update($field = [null], $where = [null])
    {
        $data = DB::table($this->table_name)
        ->where('id', '=', $where['id'])
        ->update($field);

        return $data;
    }

    public function delete($id)
    {
        $data = DB::table($this->table_name)
            ->delete($id);

        return $data;
    }

 
}