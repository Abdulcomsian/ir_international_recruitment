<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuebecLegalAspectAid extends Model
{

    protected $fillable = [
        'quebec_legal_aspect_id',
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
        return $this->img ? asset("assets/QuebecLegalAspectAid/$this->img") : null;
    }

    public function quebecLegalAspect()
    {
        return $this->belongsTo(QuebecLegalAspect::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

}
