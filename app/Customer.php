<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }

    public function odontogram()
    {
        return $this->hasOne(Odontogram::class);
    }

    public function gigi()
    {
        return $this->hasOne(GigiPasien::class);
    }

    public function ketodonto()
    {
        return $this->hasOne(KetOdontogram::class);
    }

    public function fisik()
    {
        return $this->hasOne(Fisik::class);
    }

    public function rekam()
    {
        return $this->hasMany(RekamMedis::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
