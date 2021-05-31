<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    protected $table = "interest";

    protected $fillable = [
        'event_id',
        'user_id',
        'liked',
        'joined',
        'booked'
    ];
}
