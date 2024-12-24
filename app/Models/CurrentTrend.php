<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrentTrend extends Model
{
    //

    public $appends = [
        'image_path'
    ];

    public function getImagePathAttribute()
    {
        return $this->media_url ? asset("/$this->media_url") : null;
    }

}
