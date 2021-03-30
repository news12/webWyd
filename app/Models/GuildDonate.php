<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuildDonate extends Model
{
    use HasFactory;

    protected $table = 'guild_donate';

    protected $fillable = [
        'guild_id',
        'char_id',
        'account_id',
        'gold',
        'fame',
        'status'
        
    ];
}
