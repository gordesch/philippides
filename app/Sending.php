<?php

namespace App;

use App\Scopes\SectionScope;
use Illuminate\Database\Eloquent\Model;

class Sending extends Model
{
    protected $fillable = ['title', 'body'];
    protected $with = ['section'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new SectionScope);
    }

    public function broadcast_list()
    {
        return $this->belongsToMany(BroadcastList::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
