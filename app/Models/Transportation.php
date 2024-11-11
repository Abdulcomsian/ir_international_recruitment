<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transportation extends Model
{
    protected $fillable = [
        'city_id',
        'img',
        'title',
        'type',
        'contact_no',
        'location',
        'description',
        'from_price',
        'to_price',
        'website_url'
    ];

    public $appends = [
        'image_path'
    ];

    public function getImagePathAttribute()
    {
        return $this->img ? asset("assets/Transportation/$this->img") : null;
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
