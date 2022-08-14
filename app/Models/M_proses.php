<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class M_proses extends Model
{
    use SoftDeletes;
    public $incrementing = false;
    protected $table = "m_proses";
    protected $primaryKey = "id_m_proses";
    protected $dates = ['deleted_at'];

    const ID_M_PROSES_KONFIRMASI_PEMBAYARAN = 4;

    protected $fillable = ['nm_m_proses'];

    /* fungsi untuk menjalankan event ketika melakukan 'creating' pada model */
    protected static function boot()
    {
        parent::boot();

        M_proses::creating(function($model) {
            $model->id_m_proses = M_proses::max('id_m_proses') + 1;
        });
    }


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max($this->primaryKey)+1;
    }

}
