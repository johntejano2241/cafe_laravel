<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Verify extends Model
{
    use HasFactory;

    protected $table = 'player_verify';

    protected $fillable = [
        'account_id',
        'category',
        'token',
        'date_created',
    ];

    public $timestamps = false;
}
