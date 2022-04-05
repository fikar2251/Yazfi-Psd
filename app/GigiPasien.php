<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GigiPasien extends Model
{
    protected $table = 'gigipasien';
    protected $guarded = [];

    public function pasien()
    {
        return $this->belongsTo(Customer::class);
    }
}
