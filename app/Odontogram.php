<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Odontogram extends Model
{
    protected $table = 'odontogram_pasien';
    protected $guarded = [];

    public function pasien()
    {
        return $this->belongsTo(Customer::class);
    }
}
