<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleCity extends Model
{
    use HasFactory;

    protected $table = 'sale_city';

    protected $fillable = [
        'item_id',
        'id_account',
        'id_char',
        'price',
        'status',
        'city',
        'ef1',
        'efv1',
        'ef2',
        'efv2',
        'ef3',
        'efv3',
        'date_init',
        'date_end'
        
    ];
}
