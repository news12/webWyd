<?php

namespace App\Repositories\Eloquent;

use App\Models\Storage;
use App\Models\NoTrade;
use App\Repositories\Contract\StorageRepositoryInterface;
use Illuminate\Support\Facades\DB;

class StorageRepository implements StorageRepositoryInterface
{

    private $table_name = 'char_storage';
    private $table_noTrade = 'no_trade';
    protected $model = Storage::class;
    protected $noTrade = NoTrade::class;

    public function all($table, $field = ['*'])
    {
    
        $data = DB::table($table['table'])
                ->select($field)
                ->get();

       return $data; 
    }


    public function getStorage($field = ['*'],$where = [null])
    {
        $data = DB::table($this->table_name)
            ->join('users', 'char_storage.id_account', '=', 'users.id')
            ->leftjoin('itemlist','char_storage.itemID', '=', 'itemlist.id')
            ->leftjoin('no_trade', 'char_storage.itemID', '=', 'no_trade.id')
            ->select('char_storage.*','users.name as account', 'itemlist.name as item_name', DB::raw('IF(no_trade.id, 1, 0) as notrade'))
            ->where('id_account', $where['accountID'])
            ->get();
            
            

          // dd($data);

        return $data;
    }

    public function nGet($table, $field = ['*'], $id)
    {
        $table = $table['table'];

        $data = DB::table($table)
       ->select($field)
        ->where('id', $id)
        ->get();
        
     
      // dd($data);

    return $data;

    }



    public function nCount($field = ['*'],$where = [null])
    {
        $data = DB::table($this->table_name)
            ->select($field)
            ->where('id_account', $where['id_account'])
            ->where('slot', $where['slot'])
            ->where('itemID', $where['id_item'])
            ->count();
            
            

           // dd($data);

        return $data;
    }

    public function nGetStatus($field = ['*'],$where = [null])
    {
        $data = DB::table($this->table_name)
            ->select($field)
            ->where('id_account', $where['id_account'])
            ->where('slot', $where['slot'])
            ->where('itemID', $where['id_item'])
            ->get();
            
            

           // dd($data);

        return $data;
    }

    public function update($field = [null], $where = [null])
    {
        $update = DB::table($this->table_name)
        ->where('slot', '=', $where['slot'])
        ->where('id_account', '=', $where['id_account'])
        ->update($field);
    }

 
}