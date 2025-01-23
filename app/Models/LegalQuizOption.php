<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalQuizOption extends Model
{
    protected $fillable = [
        'legal_aspect_questions_id', // Add question_id here
        'answer_text',
        'is_correct',
    ];
    public function question()
    {
        return $this->belongsTo(LegalAspectQuestion::class);
    }
}
