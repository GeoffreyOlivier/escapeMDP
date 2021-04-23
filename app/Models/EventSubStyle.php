<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSubStyle extends Model
{
    use HasFactory;

    protected $table = "event_substyle";
    protected $fillable = ['deprecated', 'substyle_id', 'event_id'];

}
