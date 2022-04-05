<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KetOdontogram extends Model
{
    protected $guarded = ['id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
