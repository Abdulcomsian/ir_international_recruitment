<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForeignDiploma extends Model
{

    public $appends = [
        'media_path'
    ];

    public function getMediaPathAttribute()
    {
        return $this->media_url ? asset("/$this->media_url") : null;
    }
    public function ValidationGuide()
    {
        return $this->hasMany(ValidationGuide::class,'diploma_id');
    }

    public function resources()
    {
        return $this->hasMany(UsefulResource::class,'diploma_id');
    }


}
