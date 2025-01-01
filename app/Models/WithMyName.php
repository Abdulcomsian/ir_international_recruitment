<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithMyName extends Model
{

    protected $fillable = [
        'complain_no',
        'name',
        'country_code',
        'phone_no',
        'address',
        'description',
        'img_proof',
        'voice_msg'
    ];

    public $appends = [
        'image_proof_path',
        'voice_msg_path',
        'contact_no'
    ];

    public function getImageProofPathAttribute()
    {
        return $this->img_proof ? asset("assets/WithMyName/$this->img_proof") : null;
    }

    public function getVoiceMsgPathAttribute()
    {
        return $this->voice_msg ? asset("assets/WithMyName/$this->voice_msg") : null;
    }

    public function getContactNoAttribute()
    {
        return $this->country_code . $this->phone_no;
    }

}
