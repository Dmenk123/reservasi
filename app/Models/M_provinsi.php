<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_provinsi extends Model
{
    protected $table = "m_provinsi";
    protected $primaryKey = "id_m_provinsi";


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max('id_m_provinsi')+1;
    }

    public function m_provinsi()
    {
        return $this->belongsTo(\App\Models\M_provinsi::class,'id_m_provinsi','id_m_provinsi');
    }

}
