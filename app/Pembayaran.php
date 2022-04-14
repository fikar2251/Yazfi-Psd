<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran_unit';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function rincian()
    {
        return $this->belongsTo(Tagihan::class, 'rincian_id');
    }

    public function bayartagihan()
    {
        return $this->hasMany(BayarTagihan::class, 'pembayaran_id');
    }
}
