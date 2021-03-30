<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;

    protected $table = 'char_storage';

    protected $fillable = [
        'name',
        'id_account',
        'slot',
        'ef1',
        'efv1',
        'ef2',
        'efv2',
        'ef3',
        'efv3'
        
    ];

}
