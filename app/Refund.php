<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $table = 'refund';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function pembatalan()
    {
        return $this->belongsTo(PembatalanUnit::class, 'pembatalan_id');
    }

    public function sumber()
    {
        return $this->belongsTo(Chart::class, 'sumber_pembayaran');
    }
}
