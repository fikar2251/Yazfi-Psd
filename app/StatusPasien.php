<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusPasien extends Model
{
    protected $guarded = ['id'];

    public function booking()
    {
        return $this->hasMany(Booking::class, 'status_kedatangan');
    }
}
