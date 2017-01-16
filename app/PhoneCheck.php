<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneCheck extends Model
{
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
