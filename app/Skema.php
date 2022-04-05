<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skema extends Model
{
    protected $table = 'skema_pembayaran';
    protected $guarded = ['id_skema'];
    protected $primaryKey = 'id_skema';
    public $timestamps =  false;

    public function sprr()
    {
        return $this->hasOne(Spr::class, 'skema');
    }
}
