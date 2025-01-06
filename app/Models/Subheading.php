<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subheading extends Model
{
    protected $fillable=[
        'faculty_id',
        'subheading'
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id','id');
    }
}
