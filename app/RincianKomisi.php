<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RincianKomisi extends Model
{
    protected $table = 'rincian_komisi';
    protected $guarded = [];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
