<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
    // public function golongan()
    // {
    //     return $this->belongsTo(Golongan::class);
    // }
    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }
    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class);
    }
    public function status_pernikahan()
    {
        return $this->belongsTo(StatusPernikahan::class, 'status_perkawinan_id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function applies()
    {
        return $this->hasMany(Apply::class);
    }
    public function disposisi()
    {
        return $this->hasMany(Disposisi::class);
    }
    public function response()
    {
        return $this->hasMany(Response::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    public function file_pegawai()
    {
        return $this->hasMany(FilePegawai::class);
    }
    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
