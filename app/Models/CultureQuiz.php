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

    public function overview()
    {
        return $this->hasOne(CultureOverview::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
