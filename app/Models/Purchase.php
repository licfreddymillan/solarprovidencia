<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = "purchases";

    protected $fillable = ['user_id', 'course_id', 'event_id', 'amount', 'payment_method', 'payment_id', 'date', 'status'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }
}
