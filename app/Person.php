<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at', 'mobile_phone_checked_at'];
    protected $fillable = ['first_name', 'last_name', 'address', 'zipcode', 'city', 'mobile_phone', 'landline', 'university', 'major', 'email', 'messageable', 'comments'];

    public function list_subscribers()
    {
        return $this->hasMany(ListSubscriber::class);
    }

    public function long_virtual_number()
    {
        return $this->belongsTo(VirtualNumber::class, 'long_virtual_number_id');
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
}
