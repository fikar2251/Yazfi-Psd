<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gajians extends Model
{
    protected $guarded = ['id'];
    protected $table = 'gajians';
    public $timestamps = false;

    public function role(){
        return $this->belongsTo(Roles::class,'id_role');
    }
}
