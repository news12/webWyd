<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuildInOut extends Model
{
    use HasFactory;

    protected $table = 'guild_in_out';

    protected $fillable = [
        'char_id',
        'guild_id',
        'account_id',
        'ntype',
        'status',
        'date',
        'price',
        'office_id'
        
    ];
}
