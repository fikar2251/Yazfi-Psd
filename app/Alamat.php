<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    protected $table = 'alamat';
    protected $guarded =  ['id'];
    public $timestamps = false;

    public function spr()
    {
        return $this->hasOne(Spr::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinces::class, 'provinsi_id');
    }

    public function kota()
    {
        return $this->belongsTo(City::class, 'kota_id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(District::class, 'kecamatan_id');
    }

    public function desa()
    {
        return $this->belongsTo(Subdistrict::class, 'desa_id');
    }
}
