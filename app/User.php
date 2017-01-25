<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'telegram_user_id',];
    protected $hidden = ['password', 'remember_token',];

    public function isSuperAdmin()
    {
        return $this->role->type === 'super';
    }

    public function isAdmin()
    {
        return $this->role->type === ('admin' || 'super');
    }

    public function isManager()
    {
        return $this->role->type === ('manager' || 'admin' || 'super');
    }

    public function isSectionScoped()
    {
        if ($this->role->scope !== 'section') {
            return false;
        }
        return true;
    }

    public function messages_sent()
    {
        return $this->morphMany(Message::class, 'senderable');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function routeNotificationForTelegram()
    {
        return $this->telegram_user_id;
    }
}
