<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrentTrend extends Model
{
    //

    public $appends = [
        'image_path',
        'category_name'
    ];

    public function getImagePathAttribute()
    {
        return $this->media_url ? asset("/$this->media_url") : null;
    }

    public function getCategoryNameAttribute()
    {
        return ucfirst(str_replace('_',' ', $this->category));
    }

}
