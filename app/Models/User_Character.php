<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Character extends Model
{
    use HasFactory;

    protected $table = 'player_character';


    protected $fillable = [
        'account_id',
        'character_name',
        'character_sex',
        'character_data',
    ];

    public $timestamps = false;


}
