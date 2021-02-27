<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = "events";

    protected $fillable = ['title', 'slug', 'description', 'place', 'date', 'time', 'price', 'cover', 'link', 'video', 'live', 'status'];

    public function users(){
    	return $this->belongsToMany('App\Models\User', 'events_users', 'event_id', 'user_id');
    }

    public function purchases(){
    	return $this->hasMany('App\Models\Purchase');
    }

    public function transfers(){
        return $this->hasMany('App\Models\Transfer');
    }
}
