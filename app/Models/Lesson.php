<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $table = "lessons";

    protected $fillable = ['course_id', 'title', 'slug', 'subtitle', 'description', 'video', 'duration', 'status'];

    public function category(){
    	return $this->belongsTo('App\Models\Course');
    }
}
