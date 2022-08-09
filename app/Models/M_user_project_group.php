<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_user_project_group extends Model
{
    protected $table = "m_user_project_group";
    protected $primaryKey = "id_m_user_project_group";


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max('id_m_user_project_group')+1;
    }
}
