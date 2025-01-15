<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public function financialAid()
    {
        return $this->hasOne(FinancialAid::class,'program_id','id');
    }
}
