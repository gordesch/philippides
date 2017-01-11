<?php

namespace App;

use App\Scopes\SectionScope;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $with = ['section', 'sending.broadcast_list', 'senderable', 'recipientable'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new SectionScope);
    }

    public function recipientable()
    {
        return $this->morphTo();
    }

    public function senderable()
    {
        return $this->morphTo();
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function sending()
    {
        return $this->belongsTo(sending::class);
    }
}
