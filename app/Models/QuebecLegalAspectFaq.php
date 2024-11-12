<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuebecLegalAspectFaq extends Model
{

    protected $fillable = [
        'quebec_legal_aspect_id',
        'title',
        'description'
    ];

    public function quebecLegalAspect()
    {
        return $this->belongsTo(QuebecLegalAspect::class);
    }

}
