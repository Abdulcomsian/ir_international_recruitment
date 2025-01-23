<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalAspectQuestion extends Model
{
    protected $fillable = [
        'legal_aspect_quiz_categories_id', // Add culture_quiz_id here
        'featured_image',
        'question_text',
        'question_type',
       
    ];
    public function getoptions()
    {
        return $this->hasMany(LegalQuizOption::class,'legal_aspect_questions_id','id');
    }

    public function getquizCategory()
    {
        return $this->belongsTo(LegalAspectQuizCategory::class);
    }
}
