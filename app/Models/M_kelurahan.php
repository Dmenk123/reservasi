<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_kelurahan extends Model
{
    protected $table = "m_kelurahan";
    protected $primaryKey = "id_m_kelurahan";


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max('id_m_kelurahan')+1;
    }

    public function m_kecamatan()
    {
        return $this->belongsTo(\App\Models\M_kecamatan::class,'id_m_kecamatan','id_m_kecamatan');
    }

}
