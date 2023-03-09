<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Item extends Model
{
    use HasFactory;

    protected $table = 'player_item';

    protected $fillable = [
        'account_id',
        'category',
        'item',
        'date_acquired',
    ];

    public $timestamps = false;


}
