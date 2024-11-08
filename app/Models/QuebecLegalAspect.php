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

}
