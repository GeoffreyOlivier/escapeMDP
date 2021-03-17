<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventBookedUser extends Model
{
    use HasFactory;

    protected $table = "event_booked_users";

    protected $fillable = ['deprecated', 'user_id', 'event_id'];
}
