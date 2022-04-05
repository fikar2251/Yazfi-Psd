<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $guarded = ['id'];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
}
