<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtualNumber extends Model
{
    protected $fillable = ['mobile_phone', 'type'];

    public function people()
    {
        return $this->hasMany(Person::class);
    }
}
