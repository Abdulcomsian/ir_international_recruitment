<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryQuebec extends Model
{
    protected $fillable = [
        'category_id',
        'featured_image',
        'title',
        'sections'
    ];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

}
