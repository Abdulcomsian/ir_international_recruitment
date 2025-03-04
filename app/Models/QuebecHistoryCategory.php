<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuebecHistoryCategory extends Model
{
    protected $fillable=[
        'title',
        'featured_image'
    ];

    public function sections()
    {
        return $this->hasMany(Section::class,'history_quebec_id');
    }
}
