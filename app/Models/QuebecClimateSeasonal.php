<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuebecClimateSeasonal extends Model
{

    protected $fillable = [
        'quebec_climate_id',
        'title',
        'duration_from',
        'duration_to',
        'description'
    ];

    public function quebecClimate()
    {
        return $this->belongsTo(QuebecClimate::class);
    }

}
