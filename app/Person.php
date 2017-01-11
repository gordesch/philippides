<?php

namespace App;

use App\Scopes\SectionScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at', 'mobile_phone_checked_at'];
    protected $fillable = ['first_name', 'last_name', 'address', 'zipcode', 'city', 'mobile_phone', 'landline', 'university', 'major', 'email', 'messageable', 'comments'];
    protected $with = ['section'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new SectionScope);
    }

    public function broadcast_lists()
    {
        return $this->belongsToMany(BroadcastList::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'contact_id');
    }

    public function messages_sent()
    {
        return $this->morphMany(Message::class, 'senderable');
    }

    public function messages_received()
    {
        return $this->morphMany(Message::class, 'recipientable');
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function virtual_number()
    {
        return $this->belongsTo(VirtualNumber::class);
    }
}
