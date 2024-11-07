<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuebecFood extends Model
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
        return $this->img ? asset("assets/QuebecFood/$this->img") : null;
    }

}
