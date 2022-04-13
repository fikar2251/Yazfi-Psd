<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BayarTagihan extends Model
{
    protected $table = 'tagihan_pembayaran';
    protected $guarded = [];
    public $timestamps = false;
    

    public function rincian()
    {
        return $this->belongsTo(Tagihan::class, 'rincian_id');
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'pembayaran_id');
    }
}
