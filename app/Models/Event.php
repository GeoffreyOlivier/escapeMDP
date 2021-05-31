<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = "events";


    protected $fillable = [
        'title',
        'description',
        'user_id',
        'image_name',
        'image_path',
        'start_at',
        'ending_at',
        'nb_people_max',
        'need_subscribe',
        'place',
        'price',
        'address',
        'street',
        'city_id',
        'api_google_id',
        'image',
        'event_type_id',
    ];

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function eventSport()
    {
        return $this->hasMany(EventSport::class);
    }
    public function eventStyle()
    {
        return $this->belongsToMany(Style::class, 'event_style', 'event_id', 'style_id');
    }
    public function eventSubStyle()
    {
        return $this->belongsToMany(Substyle::class, 'event_substyle', 'event_id', 'substyle_id' );
    }
    public function eventArt()
    {
        return $this->hasOne(EventArt::class);
    }
    public function eventGame()
    {
        return $this->hasMany(EventGame::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'interest', 'event_id', 'user_id');
    }

    public function interest()
    {
        return $this->hasMany(Interest::class);
    }




}
