<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalAspectQuizOverview extends Model
{
    protected $fillable = [
        'legal_aspect_quiz_categories_id',
        'featured_image',
        'title_question',
        'description'
    ];
    public function getoverviewLabels()
    {
        return $this->hasMany(LegalAspectQuizOverviewLabel::class,'legal_aspect_quiz_overviews_id','id');
    }
}
