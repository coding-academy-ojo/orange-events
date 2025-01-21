<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'entity'];

    public function attendees(): BelongsToMany
    {
        return $this->belongsToMany(Attendee::class, 'attendee_contact');
    }
}
