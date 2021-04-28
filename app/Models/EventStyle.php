<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventStyle extends Model
{
    use HasFactory;

    protected $table = "event_style";

    protected $fillable = ['deprecated', 'style_id', 'event_id'];

}
