<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->hasMany(Barang::class,'id_jenis');
    }
  

}
