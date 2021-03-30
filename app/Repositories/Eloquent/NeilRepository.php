<?php

namespace App\Repositories\Eloquent;

use App\Models\Neil;
use App\Models\NeilDelivery;
use App\Models\User;
use App\Repositories\Contract\NeilRepositoryInterface;
use Illuminate\Support\Facades\DB;

class NeilRepository implements NeilRepositoryInterface
{

    protected $model = Neil::class;
    protected $delivery = NeilDelivery::class;
    protected $user = User::class;
    protected $table_name = 'neil';
    protected $table_user = 'users';
 
    public function all($field = ['*'])
    {
    
        $data = DB::table($this->table_name)
                ->leftjoin('neil_cat', $this->table_name.'.cat_id', '=', 'neil_cat.id')
                ->select('neil.*','neil_cat.name as category')
                ->orderBy('date', 'desc')
                ->get();

       return $data; 
    }

    public function get($field = [null], $where = [null])
    {
        //dd($where);
        $data = DB::table($this->table_name)
        ->where('id', '=', $where['id'])
        ->get($field);

        return $data;
    }

    public function dec_n($field, $valor, $where = [null])
    {
        $data = DB::table($this->table_name)
            ->where('id', '=', $where['id'])
            ->decrement($field, $valor);

        return $data;
    }

    public function decUser($field, $valor, $where = [null])
    {
        $data = DB::table($this->table_user)
            ->where('id', '=', $where['id'])
            ->decrement($field, $valor);

        return $data;
    }


    public function create($fields = [null])
    {
        $data = new $this->model;
        $data->item_id = $fields['item_id'];
        $data->name = $fields['name'];
        $data->desc = $fields['desc'];
        $data->stock = $fields['stock'];
        $data->cat_id = $fields['cat_id'];
        $data->type = $fields['type'];
        $data->date = $fields['date'];
        $data->price = $fields['price'];
        $data->img = $fields['img'];
        $data->ef1 = $fields['ef1'];
        $data->efv1 = $fields['efv1'];
        $data->ef2 = $fields['ef2'];
        $data->efv2 = $fields['efv2'];
        $data->ef3 = $fields['ef3'];
        $data->efv3 = $fields['efv3'];
        $data->autor = $fields['autor'];
        $data->save();

        return $data;
    }

    public function delivery($fields = [null])
    {
        $data = new $this->delivery;
        $data->item_id = $fields['item_id'];
        $data->buyer_id = $fields['buyer_id'];
        $data->neil_id = $fields['neil_id'];
        $data->status = $fields['status'];
        $data->price = $fields['price'];
        $data->date = $fields['date'];
        $data->ef1 = $fields['ef1'];
        $data->efv1 = $fields['efv1'];
        $data->ef2 = $fields['ef2'];
        $data->efv2 = $fields['efv2'];
        $data->ef3 = $fields['ef3'];
        $data->efv3 = $fields['efv3'];
        $data->delivery_fail = $fields['delivery_fail'];
        $data->delivery_day = $fields['delivery_day'];
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