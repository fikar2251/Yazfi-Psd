<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InOut extends Model
{
    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function cabang()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
