<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trivia_Model extends Model
{

    protected $table = 'trivia';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'trivia',
        'date_created',
    ];

    use HasFactory;
}
