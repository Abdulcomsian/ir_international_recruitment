<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricalEvents extends Model
{
    public function media()
    {
        return $this->hasMany(HistoricalEventsMedia::class,'historical_events_id');
    }
}
