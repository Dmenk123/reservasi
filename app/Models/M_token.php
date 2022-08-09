<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class M_token extends Model
{
    public $incrementing = false;
    protected $table = "m_token";
    protected $primaryKey = "id_m_token";


    protected $fillable = ['id_m_user_group', 'id_m_app', 'expired_at', 'created_at'];

    /* fungsi untuk menjalankan event ketika melakukan 'creating' pada model */
    protected static function boot()
    {
        parent::boot();

        M_token::creating(function($model) {
            $model->id_m_token = M_token::max('id_m_token') + 1;
        });
    }


    /* fungsi untuk mendapatkan nilai ID maksimal dari tabel */
    public function scopeMaxId($query)
    {
        return $query->max($this->primaryKey)+1;
    }

    public function m_app()
    {
        return $this->belongsTo(M_app::class, 'id_m_app', 'id_m_app');
    }

    public function m_user_group()
    {
        return $this->belongsTo(M_user_group::class, 'id_m_user_group', 'id_m_user_group');
    }


}
