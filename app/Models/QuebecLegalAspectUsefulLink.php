<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuebecLegalAspectUsefulLink extends Model
{

    protected $fillable = [
        'quebec_legal_aspect_id',
        'title',
        'link'
    ];

    public function quebecLegalAspect()
    {
        return $this->belongsTo(QuebecLegalAspect::class);
    }


}
