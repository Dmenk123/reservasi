<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_kota extends Model
{
    protected $table = "m_kota";
    protected $primaryKey = "id_m_kota";


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max('id_m_kota')+1;
    }

    public function m_provinsi()
    {
        return $this->belongsTo(\App\Models\M_provinsi::class,'id_m_provinsi','id_m_provinsi');
    }

}
