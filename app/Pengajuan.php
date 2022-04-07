<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;
use Spatie\Permission\Models\Role;


class Pengajuan extends Model
{

    protected $table = 'pengajuans';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class, 'id');
    }
  
    public function admin()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
    public function roles()
    {
        return $this->belongsTo(Role::class, 'id_roles');
    }
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan');
    }
    public function jabatan()
    {
        return $this->belongsTo(User::class, 'id_jabatans');
    }

    public function rincianPengajuan()
    {
        return $this->hasOne(RincianPengajuan::class, 'nomor_pengajuan');
    }
}
