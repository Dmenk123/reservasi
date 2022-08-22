<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class M_harga extends Model
{
    use SoftDeletes;
    protected $table = "m_harga";
    protected $primaryKey = "id_m_harga";
    protected $dates = ['deleted_at'];


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max('id_m_harga')+1;
    }

}
