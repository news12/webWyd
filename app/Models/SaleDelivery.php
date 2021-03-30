<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDelivery extends Model
{
    use HasFactory;

    protected $table = 'sale_delivery';

    protected $fillable = [
        'item_id',
        'id_account',
        'id_char',
        'id_buyer',
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
        'date_end',
        'date_buy'
        
    ];
}
