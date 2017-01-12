<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['name', 'email', 'password',];
    protected $hidden = ['password', 'remember_token',];

    public function messages_sent()
    {
        return $this->morphMany(Message::class, 'senderable');
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function virtual_number()
    {
        return $this->morphToMany(VirtualNumber::class, 'virtual_numberables');
    }
}
