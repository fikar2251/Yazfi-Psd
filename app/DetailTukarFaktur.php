<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTukarFaktur extends Model
{
    protected $guarded = ['id_detail_tukar_faktur'];
    protected $table = 'detail_tukar_fakturs';

    public function data(){ 

        return $this->belongsTo(Dokumen::class,'id_dokumen');

    }

 
}
