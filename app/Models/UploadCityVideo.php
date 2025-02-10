<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadCityVideo extends Model
{
    protected $fillable = [
        'city_id',
        'video_url',
        'is_Active',
        'featured_image',
    ];
}
