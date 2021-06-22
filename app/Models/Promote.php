<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promote extends Model
{
    use HasFactory;


    protected $table = "promotes";

    protected $fillable = [
        'event_id',
        'start_at',
        'price_per_clic',
        'nb_clic',
        'duration',
    ];
}
