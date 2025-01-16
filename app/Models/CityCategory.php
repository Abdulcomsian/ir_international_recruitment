<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityCategory extends Model
{
    protected $fillable=[
        'title',
        'featured_image',
        'url',
    ];
}
