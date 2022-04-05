<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tindakan extends Model
{
    protected $guarded  = [];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function item()
    {
        return $this->belongsTo(Barang::class, 'tindakan_id');
    }
    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }
}
