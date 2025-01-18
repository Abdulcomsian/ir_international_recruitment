<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CultureOverviewLabel extends Model
{

    protected $fillable = ['culture_overview_id', 'label', 'label_image'];

    // Define the inverse relationship with CultureOverview
    public function overview()
    {
        return $this->belongsTo(CultureOverview::class);
    }
}
