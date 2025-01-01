<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgoraEvent extends Model
{
    protected $fillable = [
        'img',
        'title',
        'price',
        'event_datetime',
        'hosted_by',
        'members',
        'location',
        'description'
    ];

    public $appends = [
        'image_path'
    ];

    public function getImagePathAttribute()
    {
        return $this->img ? asset("assets/AgoraEvent/$this->img") : null;
    }

}
