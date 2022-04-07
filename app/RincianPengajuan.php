<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RincianPengajuan extends Model
{
    protected $guarded = ['id'];
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'nomor_pengajuan');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit');
    }

}
