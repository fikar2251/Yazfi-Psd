<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    protected $table = 'kelurahans';
    protected $guarded = [];
    protected $primaryKey = 'id_kel';

    public function alamat ()
    {
        return $this->hasMany(Alamat::class, 'desa_id');
    }
}
