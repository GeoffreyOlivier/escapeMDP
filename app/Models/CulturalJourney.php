<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CulturalJourney extends Model
{
    use HasFactory;
    protected $table = "cultural_journey";

    protected $fillable = [
        'name',
    ];
}
