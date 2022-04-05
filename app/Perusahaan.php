<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $guarded = ['id'];
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id');
    }
}
