<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuebecLegalAspectNavigation extends Model
{

    protected $fillable = [
        'quebec_legal_aspect_id',
        'img',
        'title',
        'description'
    ];

    public $appends = [
        'image_path'
    ];

    public function getImagePathAttribute()
    {
        return $this->img ? asset("assets/QuebecLegalAspectNavigation/$this->img") : null;
    }

    public function quebecLegalAspect()
    {
        return $this->belongsTo(QuebecLegalAspect::class);
    }

}
