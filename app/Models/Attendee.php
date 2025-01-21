<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;



class Attendee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'entity', 'event_id'];

    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(Contact::class, 'attendee_contact');
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }


    public function tokens(){
        return $this->hasMany(AttendeeToken::class);
    }


    public function events(){
        return $this->belongsToMany(Event::class, 'attendee_event')->withPivot('confirmation', 'reason')->withTimestamps();
    }
}
