<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name'
    ];

    public function legalAid()
    {
        return $this->hasMany(QuebecLegalAspectAid::class);
    }

    public function transportation()
    {
        return $this->hasMany(Transportation::class);
    }

    public function socialServiceLegalAid()
    {
        return $this->hasMany(SocialServiceLegalAid::class);
    }

}
