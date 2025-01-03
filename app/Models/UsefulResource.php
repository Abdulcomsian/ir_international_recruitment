<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsefulResource extends Model
{
    protected $fillable=[
        'diploma_id','title','visit_website'
    ];

    public function diploma()
    {
        return $this->belongsTo(ForeignDiploma::class, 'diploma_id');
    }
}
