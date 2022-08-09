<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_menu extends Model
{
    protected $table = "m_menu";
    protected $primaryKey = "id_m_menu";


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max('id_m_menu')+1;
    }

    public function scopeIsActive($query)
    {
        return $query->where('aktif', 1);
    }

    public function m_hak_akses()
    {
        return $this->belongsTo(\App\Models\M_hak_akses::class,'id_m_menu','id_m_menu');
    }



}
