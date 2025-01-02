<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValidationGuide extends Model
{
    protected $fillable=[
        // 'title',
        'diploma_id',
        'validation_organization',
        'visit_website',
        'validation_guides',
    ];

    public function diploma()
    {
        return $this->belongsTo(ForeignDiploma::class, 'diploma_id');
    }

}
