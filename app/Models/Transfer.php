<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $table = "bank_transfers";

    protected $fillable = ['user_id', 'course_id', 'event_id', 'bank', 'transaction_number', 'amount', 'support_image', 'date'];

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
