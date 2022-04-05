<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

use Nicolaslopezj\Searchable\SearchableTrait;


class TukarFaktur extends Model
{
    use Notifiable;
    use SearchableTrait;


     /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'tukar_fakturs.no_penerimaan_barang' => 20,
       
        ]
    ];
    protected $guarded = ['id'];
    protected $table = 'tukar_fakturs';

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class, 'id');
    }
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }
    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function dokumen()
    {
        return $this->hasMany(DetailTukarFaktur::class, 'no_faktur');
    }
}
