<?php

namespace App\Repositories\Eloquent;

use App\Models\SaleCity;
use App\Models\SaleDelivery;
use App\Models\NoTrade;
use App\Repositories\Contract\SaleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use DateTime;

class SaleRepository  implements SaleRepositoryInterface
{

    protected $model = SaleCity::class;
    protected $saleCity = SaleCity::class;
    protected $saleDelivery = SaleDelivery::class;
    protected $noTrade = NoTrade::class;

    public function __construct()
    {
        $this->model = $this->resolvModel();
    }

    public function all($table, $field = ['*'])
    {
    
        $data = DB::table($table['table'])
                ->select($field)
                ->get();

       return $data; 
    }

    public function all_n($table, $city)
    {
        //$className = $this->model;
      
        $data = DB::table($table['table'])
                ->join('itemlist', $table['table'].'.item_id', 'itemlist.id')
                ->join('char', $table['table'].'.id_char', 'char.id')
                ->join('users', $table['table'].'.id_account', 'users.id')
                ->join('city', $table['table'].'.city', 'city.id')
                ->select($table['table'].'.*', 'char.name as char', 'users.login as account', 'itemlist.name as item', 'city.name as city')
                ->where($table['table'].'.status', 1)
                ->where($table['table'].'.city', $city['id'])
                ->get();

        //dd($data);
       return $data; 
    }

    public function create($table, $fields = [null], $city)
    {
        //dd($fields);
       // $new_item = new SaleCity;

       if($table['table'] == 'sale_city')
       $new_item = new $this->saleCity;
       else
       {
        $new_item = new $this->saleDelivery;
        $new_item->id_buyer = $fields['id_buyer'];
        $new_item->date_buy = $fields['date_buy'];
       }
       
        $new_item->item_id = $fields['item_id'];
        $new_item->id_account = $fields['id_account'];
        $new_item->id_char = $fields['id_char'];
        $new_item->price = $fields['price'];
        $new_item->slot_bau = $fields['slot'];
        $new_item->status =  $fields['status'];
        $new_item->city = $city['id'];
        $new_item->ef1 = $fields['ef1'];
        $new_item->efv1 = $fields['efv1'];
        $new_item->ef2 = $fields['ef2'];
        $new_item->efv2 = $fields['efv2'];
        $new_item->ef3 = $fields['ef3'];
        $new_item->efv3 = $fields['efv3'];

        $dataInit = new DateTime();
        $new_item->date_init = $dataInit;
             
        $dataEnd = new DateTime('+7 days');
        $new_item->date_end = $dataEnd;
        //dd($new_item);
        $new_item->save();

        return $new_item;
    }

    public function nCount($table, $fields = ['*'], $where = [null])
    {
        //dd($table);
        $data = DB::table($table['table'])
            ->select($fields)
            ->where($where)
            //->where('id', $where['id'])
            ->count();
            
            

           // dd($data);

        return $data;
    }

    public function get($id)
    {
        return $this->model->find($id);
    }
    

    public function nUpdate($table, $fields = ['*'], $where = [null])
    {
       // dd($table);

        $data = DB::table($table['table'])
            ->where($where)
            ->update($fields);
            
            

           // dd($data);

        return $data;
    }

    public function delete($id)
    {
      return $this->model->destroy($id);
    }





    protected function resolvModel()
    {

        return app($this->model);

    }


 
}