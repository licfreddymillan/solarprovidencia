<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = "courses";

    protected $fillable = ['title', 'slug', 'subtitle', 'description', 'category_id', 'type', 'duration', 'date', 'language', 'level', 'price', 'status', 'cover'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }

    public function users(){
        return $this->belongsToMany('App\Models\User', 'courses_users', 'course_id', 'user_id')->withPivot('progress', 'finish', 'online_class', 'start_date', 'ending_date');
    }

    public function transfers()
    {
        return $this->hasMany('App\Models\Transfer');
    }

    public function purchases()
    {
        return $this->hasMany('App\Models\Purchase');
    }
}
