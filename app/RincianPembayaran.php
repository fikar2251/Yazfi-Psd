<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RincianPembayaran extends Model
{
    protected $guarded = [];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    public function rincianpengajuan()
    {
        return $this->belongsTo(RincianPengajuan::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function komisi()
    {
        return $this->hasMany(RincianKomisi::class);
    }

    public function kasir()
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }
}
