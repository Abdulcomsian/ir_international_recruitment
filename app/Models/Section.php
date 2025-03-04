<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['history_quebec_id', 'content'];

    public function category()
    {
        return $this->belongsTo(HistoryQuebec::class);
    }
}
