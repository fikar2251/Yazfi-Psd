<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $guarded = ['id'];
    protected $table = 'warehouses';
    public $timestamps = false;


    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan');
    }
    public function purchase()
    {
        return $this->hasOne(Purchase::class, 'id_warehouse');
    }

}
