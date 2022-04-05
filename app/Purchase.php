<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;

class Purchase extends Model
{
    protected $guarded = ['id'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }
    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function roles()
    {
        return $this->hasMany(User::class, 'users.cabang_id');
    }
    public function purchase()
    {
        return $this->belongsTo(PenerimaanBarang::class, 'no_po');
    }
    public function penerimaan()
    {
        return $this->HasMany(PenerimaanBarang::class, 'id_purchase');
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'id_warehouse');
    }

}
