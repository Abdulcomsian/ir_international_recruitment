<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    protected $fillable =[
        'featured_image',
        'blog',
        'status'
    ];
}
