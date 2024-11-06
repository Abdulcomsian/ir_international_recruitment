<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForeignDiploma extends Model
{
    public function ValidationGuide()
    {
        return $this->hasMany(ValidationGuide::class,'diploma_id');
    }

    public function resources()
    {
        return $this->hasMany(UsefulResource::class,'diploma_id');
    }


}
