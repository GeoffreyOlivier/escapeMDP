<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLikedUser extends Model
{
    use HasFactory;

    protected $table = "event_liked_users";

    protected $fillable = ['deprecated', 'user_id', 'event_id'];
}
