<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class PenerimaanBarang extends Model
{

    use HasRoles;
    protected $guarded = ['id'];
    Protected $primaryKey = "id";
    
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
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
        return $this->belongsTo(User::class, 'id_user');
    }
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'id_purchase');
    }
 

    // public function roles()
    // {
    //     return $this->hasMany(User::class, 'users.cabang_id');
    // }

     
}
