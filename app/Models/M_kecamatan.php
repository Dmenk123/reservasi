<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_kecamatan extends Model
{
    protected $table = "m_kecamatan";
    protected $primaryKey = "id_m_kecamatan";


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max('id_m_kecamatan')+1;
    }

    public function m_kota()
    {
        return $this->belongsTo(\App\Models\M_kota::class,'id_m_kota','id_m_kota');
    }

}
