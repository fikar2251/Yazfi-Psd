<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'kabupatens';
    protected $guarded = [];
    protected $primaryKey = 'id_kab';

    public function alamat()
    {
        return $this->hasMany(Alamat::class, 'kota_id');
    }
}
