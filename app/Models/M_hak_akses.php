<?php

namespace App\Models;

use App\Models\M_menu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_hak_akses extends Model
{
    protected $table = "m_hak_akses";
    protected $primaryKey = "id_m_hak_akses";


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max('id_m_hak_akses')+1;
    }

    public function menu() {
        return $this->belongsTo(M_menu::class, 'id_m_menu', 'id_m_menu');
    }

    public function module() {
        return $this->belongsTo(M_module::class, 'id_m_module', 'id_m_module');
    }
}
