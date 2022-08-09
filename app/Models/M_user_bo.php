<?php

namespace App\Models;
use App\Models\M_user_group;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_user_bo extends Model
{
    protected $table = "m_user_bo";
    protected $primaryKey = "id_m_user_bo";


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max('id_m_user_bo')+1;
    }

    public function user_group() {
        return $this->belongsTo(M_user_group::class, 'id_m_user_group', 'id_m_user_group');
    }

}
