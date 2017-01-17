<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function broadcast_lists()
    {
        return $this->hasMany(BroadcastList::class);
    }

    public function messages_received()
    {
        return $this->morphMany(Message::class, 'recipientable');
    }

    public function people()
    {
        return $this->hasMany(Person::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function virtual_number()
    {
        return $this->belongsTo(VirtualNumber::class);
    }
}
