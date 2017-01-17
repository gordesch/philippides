<?php

namespace App;

use App\Scopes\SectionScope;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
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

    public function sending()
    {
        return $this->belongsTo(Sending::class);
    }
}
