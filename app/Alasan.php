<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alasan extends Model
{
    protected $table = 'alasan_pembatalan';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;
}
