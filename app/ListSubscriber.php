<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListSubscriber extends Model
{
    public function broadcast_list()
    {
        return $this->belongsTo(BroadcastList::class);
    }
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
