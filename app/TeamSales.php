<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class TeamSales extends Model
{
    

    protected $guarded = ['id'];
    protected $table = 'team_sales_user';
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class,'id_sales');
    }
    public function manager()
    {
        return $this->belongsTo(User::class,'id_manager');
    }
    public function spv()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
