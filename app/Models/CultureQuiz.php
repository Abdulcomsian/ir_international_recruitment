<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CultureQuiz extends Model
{
    protected $fillable = [
        'title',
        'featured_image',
        'description'
    ];
}
