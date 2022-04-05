<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HargaProdukCabang extends Model
{
    protected $guarded = ['id'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function product()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
