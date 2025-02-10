<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityService extends Model
{
    protected $fillable = [
        'title',
        'category',
        'keyword',
    ];
}
