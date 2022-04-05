<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransferStok extends Model
{
    protected $guarded = [];

    public function asal()
    {
        return $this->belongsTo(Cabang::class, 'asal_id');
    }

    public function tujuan()
    {
        return $this->belongsTo(Cabang::class, 'tujuan_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
