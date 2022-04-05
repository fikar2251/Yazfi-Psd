<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $guarded = ['id'];
    protected $table = "jabatans";
    public function perusahaan()
    {
        return  $this->belongsTo(Perusahaan::class, 'id_perusahaan');
    }
}
