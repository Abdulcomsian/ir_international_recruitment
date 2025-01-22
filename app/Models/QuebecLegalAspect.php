<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuebecLegalAspect extends Model
{
    protected $fillable = [
        'img',
        'title',
        'type',
        'description'
    ];

    public $appends = [
        'image_path'
    ];

    public function getImagePathAttribute()
    {
        return $this->img ? asset("assets/QuebecLegalAspect/$this->img") : null;
    }

    public function legalAspectQuiz()
    {
        return $this->hasMany(LegalAspectQuizCategory::class,'quebec_legal_aspect_id');
    }

}
