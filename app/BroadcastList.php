<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BroadcastList extends Model
{
    protected $fillable = ['name'];

    public function list_subscribers()
    {
        return $this->hasMany(ListSubscriber::class);
    }

    public function broadcast_messages()
    {
        return $this->hasMany(BroadcastMessage::class);
    }
}
