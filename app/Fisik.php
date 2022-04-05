<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fisik extends Model
{
    protected $guarded = ['id'];

    public function pasien()
    {
        return $this->belongsTo(Customer::class);
    }
}
