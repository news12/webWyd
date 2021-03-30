<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NeilDelivery extends Model
{
    use HasFactory;

    protected $table = 'neil_delivery';

    protected $fillable = [
        'item_id',
        'buyer_id',
        'neil_id',
        'status',
        'price',
        'date',
        'ef1',
        'efv1',
        'ef2',
        'efv2',
        'ef3',
        'efv3',
        'dalivery_fail',
        'delivery_day'
        
    ];
}
