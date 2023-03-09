<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Score extends Model
{
    use HasFactory;

    protected $table = 'player_score';

    protected $fillable = [
        'account_id',
        'category',
        'value',
        'date_record'
    ];

    public $timestamps = false;

}
