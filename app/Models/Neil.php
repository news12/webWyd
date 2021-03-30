<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neil extends Model
{
    use HasFactory;

    protected $table = 'neil';

    protected $fillable = [
        'item_id',
        'name',
        'desc',
        'stock',
        'cat_id',
        'type',
        'date',
        'img',
        'ef1',
        'efv1',
        'ef2',
        'efv2',
        'ef3',
        'efv3',
        'price',
        'autor'
        
    ];
}
