<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question_Answer extends Model
{
    use HasFactory;

    protected $table = 'quiz';

    public $timestamps = false;


    protected $fillable = [
        'id',
        'question',
        'choice1',
        'choice2',
        'choice3',
        'choice4',
        'answer',
        'category'
    ];


}
