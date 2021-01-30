<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = "courses";

    protected $fillable = ['title', 'slug', 'subtitle', 'description', 'category_id', 'duration', 'price', 'status', 'cover'];

    public function category(){
    	return $this->belongsTo('App\Models\Category');
    }

    public function lessons(){
    	return $this->hasMany('App\Models\Lesson');
    }
}
