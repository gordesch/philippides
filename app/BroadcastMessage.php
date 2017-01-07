<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BroadcastMessage extends Model
{
    protected $fillable = ['title', 'body'];

    public function broadcast_list()
    {
        return $this->belongsTo(BroadcastList::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
