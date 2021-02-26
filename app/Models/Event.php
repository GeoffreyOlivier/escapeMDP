<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'start_at',
        'ending_at',
        'nb_people_max',
        'need_subscribe',
        'place',
        'address',
        'street',
        'town',
        'api_google_id',
        'image',
        'event_type_id',
    ];
}
