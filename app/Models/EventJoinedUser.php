<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventJoinedUser extends Model
{
    use HasFactory;

    protected $table = "event_joined_users";

    protected $fillable = ['deprecated', 'user_id', 'event_id'];
}
