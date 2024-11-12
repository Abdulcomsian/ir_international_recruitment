<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialServiceLegalAid extends Model
{
    protected $fillable = [
        'city_id',
        'img',
        'title',
        'email',
        'phone_no',
        'address'
    ];

    public $appends = [
        'image_path'
    ];

    public function getImagePathAttribute()
    {
        return $this->img ? asset("assets/SocialServiceLegalAid/$this->img") : null;
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
