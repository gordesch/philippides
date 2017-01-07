<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['broadcast_message_id', 'person_id', 'ovh_sms_id', 'choices'];

    public function broadcast_list()
    {
        return $this->belongsTo(BroadcastList::class);
    }

    public function broadcast_message()
    {
        return $this->belongsTo(BroadcastMessage::class);
    }

    public function recipient()
    {
        return $this->belongsTo(Person::class, 'recipient_id');
    }
}
