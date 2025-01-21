<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;
    


    protected $fillable = [
        'admin_id',
        'title',
        'location',
        'start_date_time',
        'end_date_time',
        'short_description',
        'long_description',
        'status',
        'location_link'
    ];
    
    protected $dates = ['deleted_at'];
    
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function attendees()
    {
        return $this->hasMany(Attendee::class);
    }

    public function event_image(){
        return $this->hasOne(EventImage::class);
    }


    public function tokens(){
        return $this->hasMany(AttendeeToken::class);
    }


    public function attendee_confirmations(){
        return $this->belongsToMany(Attendee::class, 'attendee_event')->withPivot('confirmation', 'reason')->withTimestamps();;;
    }

}
