<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NeilCat extends Model
{
    use HasFactory;

    protected $table = 'neil_cat';

    protected $fillable = [
        'name',
        'desc'
        
    ];
}
