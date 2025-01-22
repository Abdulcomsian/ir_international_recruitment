<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalAspectQuizCategory extends Model
{
    protected $fillable = [
        'quebec_legal_aspect_id',
        'featured_image',
        'title',
        'description',
    ];

    public function quebecLegalAspect()
    {
        return $this->belongsTo(QuebecLegalAspect::class);
    }

    public function quizOverviews()
    {
        return $this->hasMany(LegalAspectQuizOverview::class, 'legal_aspect_quiz_categories_id', 'id');
    }

}
