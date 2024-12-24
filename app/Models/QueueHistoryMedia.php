<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QueueHistoryMedia extends Model
{
    protected $fillable = ['history_id', 'media_url', 'is_featured'];

    public $appends = [
        'media_path'
    ];

    public function getMediaPathAttribute()
    {
        return $this->media_url ? asset("/assets/QuebecHistory_images/$this->media_url") : null;
    }

    // public function quebecHistory()
    // {
    //     return $this->belongsTo(QuebecHistory::class,'history_id');
    // }
}
