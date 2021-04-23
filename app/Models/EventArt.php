<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventArt extends Model
{
    use HasFactory;


    protected $fillable = ['deprecated', 'cultural_journey_id', 'event_id'];
}
