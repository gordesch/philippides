<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at', 'mobile_phone_checked_at'];
    protected $fillable = ['first_name', 'last_name', 'address', 'zipcode', 'city', 'mobile_phone', 'landline', 'mobile_phone', 'university', 'major', 'email', 'messageable', 'comments'];

    public function list_subscribers()
    {
        return $this->hasMany(ListSubscriber::class);
    }
}
