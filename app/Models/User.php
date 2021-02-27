<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'country',
        'password',
        'rol'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses(){
        return $this->belongsToMany('App\Models\Course', 'courses_users', 'user_id', 'course_id')->withPivot('progress', 'finish', 'online_class', 'start_date', 'ending_date');
    }

    public function transfers()
    {
        return $this->hasMany('App\Models\Transfer');
    }

    public function purchases()
    {
        return $this->hasMany('App\Models\Purchase');
    }

     public function lessons(){
        return $this->belongsToMany('App\Models\Lesson', 'lessons_users', 'user_id', 'lesson_id')->withPivot('view_at');
    }

     public function events(){
        return $this->belongsToMany('App\Models\Event', 'events_users', 'user_id', 'event_id');
    }

}
