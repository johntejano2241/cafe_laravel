<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_Model extends Model
{
    use HasFactory;

    protected $table = 'admin';

    protected $fillable = [
        'id',
        'username',
        'password',
        'auth_token',
        'created_at',
        'updated_at'
    ];

}
