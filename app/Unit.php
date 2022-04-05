<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{


    protected $table = 'units';
    protected $guarded = ['id'];
    public $timestamps = false;

 
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan');
    }
    public function pegawais()
    {
        return $this->hasMany(Pegawai::class);
    }
}
