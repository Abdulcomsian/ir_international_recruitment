<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationProgramsDetails extends Model
{
    public function educationProgram()
    {
        return $this->belongsTo(EductionProgram::class, 'eduction_programs_id');
    }

}
