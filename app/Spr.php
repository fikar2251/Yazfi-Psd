<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spr extends Model
{
    protected $table = 'spr';
    protected $guarded = ['id_transaksi'];
    protected $primaryKey = 'id_transaksi';
    public $timestamps = false;

    public function tagihan()
    {
        return $this->hasOne(Tagihan::class, 'id_spr');
    }

    public function unit()
    {
        return $this->belongsTo(Rumah::class, 'id_unit');
    }

    public function skema_pembayaran()
    {
        return $this->belongsTo(Skema::class, 'skema');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_sales');
    }

    public function pembatalan()
    {
        return $this->hasOne(PembatalanUnit::class, 'spr_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'id_project');
    }

    public function alamat()
    {
        return $this->belongsTo(Alamat::class);
    }
}


