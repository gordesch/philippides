<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function broadcast_lists()
    {
        return $this->belongsToMany(BroadcastList::class);
    }

    public function messages_received()
    {
        return $this->morphMany(Message::class, 'recipientable');
    }

    public function people()
    {
        return $this->hasMany(Person::class);
    }

    public function virtual_number()
    {
        return $this->morphToMany(VirtualNumber::class, 'virtual_numberables');
    }
}
