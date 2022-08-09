<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_libur extends Model
{
    protected $table = "m_libur";
    protected $primaryKey = "id_m_libur";


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max('id_m_libur')+1;
    }

    // public function m_branch() {
    //     return $this->belongsTo(M_branch::class, 'id_m_branch', 'id_m_branch');
    // }

    // public function m_branch_company() {
    //     return $this->belongsTo(M_branch_company::class, 'id_m_branch_company', 'id_m_branch_company');
    // }

}
