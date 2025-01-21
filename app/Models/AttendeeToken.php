<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendeeToken extends Model
{
    use HasFactory;

    protected $fillable = ['attendee_id', 'event_id', 'token', 'expired_at'];


    public function attendee(){
        return $this->belongsTo(Attendee::class);
    }


    public function event(){
        return $this->belongsTo(Event::class);
    }
}
