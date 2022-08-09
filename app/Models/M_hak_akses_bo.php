<?php

namespace App\Models;

use App\Models\M_menu_bo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_hak_akses_bo extends Model
{
    protected $table = "m_hak_akses_bo";
    protected $primaryKey = "id_m_hak_akses_bo";


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max('id_m_hak_akses_bo')+1;
    }

    public function menu() {
        return $this->belongsTo(M_menu_bo::class, 'id_m_menu_bo', 'id_m_menu_bo');
    }

}
