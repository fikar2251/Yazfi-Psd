<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    protected $table = 'provinsis';
    protected $guarded = [];
    protected $primaryKey = 'id_prov';

    public function alamat()
    {
        return $this->hasMany(Alamat::class, 'provinsi_id');
    }
}
