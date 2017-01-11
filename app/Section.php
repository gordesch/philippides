<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function messages_received()
    {
        return $this->morphMany(Message::class, 'recipientable');
    }

    public function people()
    {
        return $this->hasMany(Person::class);
    }
}
