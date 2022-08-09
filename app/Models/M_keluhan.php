<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_keluhan extends Model
{
    protected $table = "m_keluhan";
    protected $primaryKey = "id_m_keluhan";


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max('id_m_keluhan')+1;
    }

    // public function m_kota()
    // {
    //     return $this->belongsTo(\App\Models\M_kota::class,'id_m_kota','id_m_kota');
    // }

}
