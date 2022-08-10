<?php

namespace App\Models;
use App\Models\M_user_group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class M_user extends Model
{
    use SoftDeletes;
    protected $table = "m_user";
    protected $primaryKey = "id_m_user";
    protected $dates = ['deleted_at'];


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max('id_m_user')+1;
    }

    public function user_group() {
        return $this->belongsTo(M_user_group::class, 'id_m_user_group', 'id_m_user_group');
    }

}
