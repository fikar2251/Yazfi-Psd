<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    protected $table = 'chart_of_account';
    protected $primaryKey = 'id_chart_of_account';
    
    public function refund()
    {
        return $this->hasMany(Refund::class, 'sumber_pembayaran');
    }
}