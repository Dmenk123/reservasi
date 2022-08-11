<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class M_menu_bo extends Model
{
    use SoftDeletes;
    protected $table = "m_menu_bo";
    protected $primaryKey = "id_m_menu_bo";
    protected $dates = ['deleted_at'];


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max('id_m_menu_bo')+1;
    }

    public function m_hak_akses()
    {
        return $this->belongsTo(\App\Models\M_hak_akses_bo::class,'id_m_menu_bo','id_m_menu_bo');
    }


}
