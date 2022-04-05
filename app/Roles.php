<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
  
    protected $table = 'roles';
    protected $guarded = ['id'];
    public $timestamps = false;

 
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'id_perusahaan');
    }
  
}
