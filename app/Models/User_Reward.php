<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Reward extends Model
{
    use HasFactory;

    protected $table = 'player_reward';

    protected $fillable = [
        'account_id',
        'category',
        'datetime'
    ];

    public $timestamps = false;

}
