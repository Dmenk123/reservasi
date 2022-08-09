<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class M_app extends Model
{
    public $incrementing = false;
    protected $table = "m_app";
    protected $primaryKey = "id_m_app";


    protected $fillable = ['id_m_app', 'nm_m_app', 'is_active_m_app', 'created_at'];

    /* fungsi untuk menjalankan event ketika melakukan 'creating' pada model */
    protected static function boot()
    {
        parent::boot();

        M_app::creating(function($model) {
            $model->id_m_app = M_app::max('id_m_app') + 1;
        });
    }


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max($this->primaryKey)+1;
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active_m_app', 1);
    }

}
