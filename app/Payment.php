<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = ['id'];

    public function rincian()
    {
        return $this->hasMany(RincianPembayaran::class);
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
}
