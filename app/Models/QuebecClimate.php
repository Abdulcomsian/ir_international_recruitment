<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuebecClimate extends Model
{
    protected $fillable = [
        'img',
        'title',
        'description'
    ];

    public $appends = [
        'image_path'
    ];

    public function getImagePathAttribute()
    {
        return $this->img ? asset("assets/QuebecClimate/$this->img") : null;
    }

    public function seasonal()
    {
        return $this->hasOne(QuebecClimateSeasonal::class);
    }
}
