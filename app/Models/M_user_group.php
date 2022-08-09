<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_user_group extends Model
{
    protected $table = "m_user_group";
    protected $primaryKey = "id_m_user_group";


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max('id_m_user_group')+1;
    }

    public function m_app()
    {
        return $this->belongsTo(M_app::class, 'id_m_app', 'id_m_app');
    }

    // public function t_content()
    // {
    //     return $this->belongsToMany(T_content::class, 't_group_content', 'id_m_user_group', 'id_t_content');
    // }

}
