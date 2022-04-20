<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChartOfAccount extends Model
{
    protected $table = 'new_chart_of_account';
    
    public function parent()
    {
        return $this->belongsTo(self::class, 'child_numb');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'child_numb');
    }

    public function category()
    {
        return $this->belongsTo(CatChartOfAccount::class, 'cat_id');
    }
}
