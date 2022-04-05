<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = ['id'];
    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
    public function inout()
    {
        return $this->hasMany(InOut::class);
    }
    public function purchase()
    {
        return $this->hasMany(Purchase::class, 'id_project');
    }
    public function hargaproduk()
    {
        return $this->belongsTo(HargaProdukCabang::class, 'project_id');
    }
}
