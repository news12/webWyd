<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuildMember extends Model
{
    use HasFactory;

    protected $table = 'guild_member';

    protected $fillable = [
        'guild_id',
        'char_id',
        'office',
        'donate',
        'contribuition',
        'donate_day',
        'donate_year'
        
    ];
}
