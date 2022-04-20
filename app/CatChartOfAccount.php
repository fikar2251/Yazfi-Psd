<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatChartOfAccount extends Model
{
    protected $table = 'cat_chart_of_account';
    protected $primaryKey = 'id_cat';
    public function chart()
    {
        return $this->hasMany(ChartOfAccount::class, 'cat_id');
    }
}
