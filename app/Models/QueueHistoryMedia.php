<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QueueHistoryMedia extends Model
{
    protected $fillable = ['history_id', 'media_url', 'is_featured'];

    // public function quebecHistory()
    // {
    //     return $this->belongsTo(QuebecHistory::class,'history_id');
    // }   
}
