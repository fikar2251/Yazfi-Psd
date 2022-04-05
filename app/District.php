<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'kecamatans';
    protected $guarded = [];
    protected $primaryKey = 'id_kec';

    public function alamat()
    {
        return $this->hasMany(Alamat::class, 'kecamatan_id');
    }
}
