<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StayAnonymous extends Model
{

    protected $fillable = [
        'complain_no',
        'img_proof',
        'address',
        'description',
        'voice_msg'
    ];

    public $appends = [
        'image_proof_path',
        'voice_msg_path'
    ];

    public function getImageProofPathAttribute()
    {
        return $this->img_proof ? asset("assets/StayAnonymous/$this->img_proof") : null;
    }

    public function getVoiceMsgPathAttribute()
    {
        return $this->voice_msg ? asset("assets/StayAnonymous/$this->voice_msg") : null;
    }

}
