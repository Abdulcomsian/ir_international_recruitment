<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable=[
        'education_program_id',
        'title',
        // 'subheading'
    ];

    public function educationProgram()
    {
        return $this->belongsTo(EducationProgramsDetails::class, 'education_program_id','id');
    }

    public function subheadings()
    {
        return $this->hasMany(Subheading::class, 'faculty_id', 'id');
    }


}
