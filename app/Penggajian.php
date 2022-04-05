<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Contracts\Role;

class Penggajian extends Model
{
    // use HasFactory;
    protected $table = 'penggajians';
    protected $guarded = ['id'];
    public $timestamps = false;
    
    public function penerimaan()
    {
        return $this->hasMany(RincianGaji::class)->where('tipe','penerimaan');
    }
    public function potongan()
    {
        return $this->hasMany(RincianGaji::class)->where('tipe','potongan');
    }
    public function pegawai()
    {
        return $this->belongsTo(User::class);
    }
    public function jabatan()
    {
        return $this->belongsTo(jabatan::class,'id_jabatan');
    }
    public function roles()
    {
        return $this->belongsTo(Roles::class,'id_roles');
    }
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class,'id_perusahaan');
    }
}
