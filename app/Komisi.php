<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Komisi extends Model
{
    protected $guarded = ['id'];
    protected $table = 'komisi';
    public $timestamps = false;

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
