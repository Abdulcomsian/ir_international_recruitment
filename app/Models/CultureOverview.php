<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CultureOverview extends Model
{
    protected $fillable = ['culture_quiz_id', 'title_question', 'description','featured_image'];

    public function labels()
    {
        return $this->hasMany(CultureOverviewLabel::class);
    }

    public function quiz()
    {
        return $this->belongsTo(CultureQuiz::class, 'culture_quiz_id');
    }
}
