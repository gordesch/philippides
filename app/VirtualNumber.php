<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtualNumber extends Model
{
    protected $fillable = ['number', 'type'];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
