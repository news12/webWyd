<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuildDelivery extends Model
{
    use HasFactory;

    protected $table = 'guild_delivery';

    protected $fillable = [
        'guild_id',
        'char_id',
        'type',
        'status',
        'gold',
        'date'
        
    ];
}
