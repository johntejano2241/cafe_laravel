<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Account extends Model
{
    use HasFactory;

    protected $table = 'player_info';

    protected $fillable = [
        'account_id',
        'first_name',
        'last_name',
        'gender',
        'birthdate',
    ];

    // time false
    public $timestamps = false;


}
