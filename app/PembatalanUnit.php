<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembatalanUnit extends Model
{
    protected $guarded = ['id'];
    protected $table = 'pembatalan_unit';
    public $timestamps = false;
   public function admin(){
       
       return $this->belongsTo(Users::class,'id_sales');
   }
   public function spr()
    {
        return $this->belongsTo(Spr::class, 'spr_id');
    }

    public function refund()
    {
        return $this->hasOne(Refund::class, 'pembatalan_id');
    }

}
