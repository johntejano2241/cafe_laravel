<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Ruby extends Model
{
    use HasFactory;

    protected $table = 'player_ruby';

    protected $fillable = [
        'account_id',
        'ruby',
    ];

    public $timestamps = false;
}
