<?php

namespace App;

use App\Scopes\SectionScope;
use Illuminate\Database\Eloquent\Model;

class BroadcastList extends Model
{
    protected $fillable = ['name'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new SectionScope);
    }

    public function sendings()
    {
        return $this->belongsToMany(Sending::class);
    }

    public function list_subscribers()
    {
        return $this->belongsToMany(Person::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
