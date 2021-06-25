<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventGame extends Model
{
    use HasFactory;

    protected $table = "event_game";


    protected $fillable = ['deprecated', 'game_id', 'event_id'];

}
