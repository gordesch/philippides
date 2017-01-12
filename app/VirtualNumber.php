<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtualNumber extends Model
{
    protected $fillable = ['number', 'type'];

    public function sections()
    {
        return $this->morphedByMany(User::class, 'virtual_numberables');
    }

    public function user()
    {
        return $this->morphedByMany(User::class, 'virtual_numberables');
    }
}
