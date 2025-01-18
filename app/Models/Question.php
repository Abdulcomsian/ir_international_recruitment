<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'culture_quiz_id', // Add culture_quiz_id here
        'question_text',
       
    ];
    public function options()
    {
        return $this->hasMany(Answer::class);
    }

    public function quiz()
    {
        return $this->belongsTo(CultureQuiz::class);
    }
}
