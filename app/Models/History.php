<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    
    public function history_images(){
        return $this->hasMany(HistoryImage::class, 'history_id')->where('type', 'history');
    }

    public function title_description(){
        return $this->hasMany(TitleDescription::class, 'history_id')->where('type', 'history');
    }
}
