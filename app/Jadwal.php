<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $guarded = ['id'];
    // protected $fillable = ['user_id', 'cabang_id','shift_id','ruang','tanggal'];
    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
