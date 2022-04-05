<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimbolOdontogram extends Model
{
    protected $guarded = [];

    public function rekam()
    {
        return $this->hasMany(RekamMedis::class);
    }
}
