<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens, Notifiable;
    

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token, $this->email));
    }


    protected $guard = 'admin';
    protected $fillable = ['full_name', 'email', 'role', 'password', 'status', 'image', 'image_path'];
    protected $dates = ['deleted_at'];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
