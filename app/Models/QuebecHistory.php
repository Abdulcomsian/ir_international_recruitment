<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuebecHistory extends Model
{
    protected $fillable=[
        'title',
        'description',
        'details'
    ];
    public function media()
    {
        return $this->hasMany(QueueHistoryMedia::class, 'quebec_history_id');
    }

    
}
