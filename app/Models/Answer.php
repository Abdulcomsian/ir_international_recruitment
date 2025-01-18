<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'question_id', // Add question_id here
        'answer_text',
        'is_correct',
    ];
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
