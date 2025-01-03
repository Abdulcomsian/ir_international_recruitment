<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EductionProgram extends Model
{
    //
    public $appends = [
        'image_path'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getImagePathAttribute()
    {
        return $this->featured_image ? asset($this->featured_image) : null;
    }
}
