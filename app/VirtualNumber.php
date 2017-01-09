<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VirtualNumber extends Model
{
    protected $fillable = ['mobile_phone', 'type'];

    public function people()
    {
        return $this->hasMany(Person::class);
    }

    public function messages_sent()
    {
        return $this->morphMany(Message::class, 'senderable');
    }

    public function messages_received()
    {
        return $this->morphMany(Message::class, 'recipientable');
    }
}
