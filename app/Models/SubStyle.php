<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubStyle extends Model
{
    use HasFactory;

    protected $table = "substyle";

    protected $fillable = [
        'name'
    ];

}
