<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSport extends Model
{
    use HasFactory;

    protected $table = "event_sport";

    protected $fillable = ['deprecated', 'sport_id', 'event_id'];
}