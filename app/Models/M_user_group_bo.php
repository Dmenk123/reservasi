<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class M_user_group_bo extends Model
{
    use SoftDeletes;
    protected $table = "m_user_group_bo";
    protected $primaryKey = "id_m_user_group_bo";
    protected $dates = ['deleted_at'];


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max('id_m_user_group_bo')+1;
    }

}
