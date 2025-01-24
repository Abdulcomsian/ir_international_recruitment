<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalAspectQuizResult extends Model
{
    protected $fillable = [
        'user_id',
        'legal_aspect_quiz_categories_id',
        'total_questions',
        'correct_answers',
    ];
}
