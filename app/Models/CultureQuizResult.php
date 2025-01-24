<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CultureQuizResult extends Model
{
    protected $fillable=[
        'user_id',
        'culture_quiz_id',
        'total_questions',
        'correct_answers',
    ];
}
