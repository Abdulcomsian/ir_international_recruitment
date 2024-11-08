<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuebecClimateRecommendedActivity extends Model
{
    protected $fillable = [
        'quebec_climate_id',
        'img',
        'type',
        'title',
        'description'
    ];

    public $appends = [
        'image_path'
    ];

    public function getImagePathAttribute()
    {
        return $this->img ? asset("assets/QuebecClimatePackingList/$this->img") : null;
    }

    public function quebecClimate()
    {
        return $this->belongsTo(QuebecClimate::class);
    }
}
