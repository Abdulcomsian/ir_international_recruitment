<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialAid extends Model
{
    public function program()
    {
        return $this->belongsTo(Program::class,'program_id','id');
    }
}
